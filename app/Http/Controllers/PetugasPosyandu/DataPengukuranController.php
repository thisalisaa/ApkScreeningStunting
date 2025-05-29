<?php

namespace App\Http\Controllers\PetugasPosyandu;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPengukuranExport;
use App\Helpers\PerhitunganUmur;
use App\Helpers\PerhitunganZscore;
use App\Http\Controllers\Controller;
use App\Imports\DataPengukuranImport;
use App\Models\Balita;
use App\Models\DataAntropometri;
use App\Models\DataPengukuran;
use App\Models\HasilScreening;
use App\Models\Posyandu;



class DataPengukuranController extends Controller
{
    public function index(Request $request)
    {

        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $search = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $tanggalFilter = \Carbon\Carbon::create($tahun, $bulan)->endOfMonth();

        $user = Auth::user();
        $query = Balita::where('id_posyandu', $user->id_posyandu)
            ->whereDate('tanggal_lahir', '<=', $tanggalFilter);


        if ($search) {
            $query->where('nama_balita', 'like', '%' . $search . '%');
        }

        $query->orderBy('nama_balita', 'asc');
        $balitas = $query->paginate($perPage)->appends($request->query());

        // Ambil data pengukuran berdasarkan bulan & tahun
        $data_balitas = $balitas->map(function ($balita) use ($bulan, $tahun) {
            $pengukuran = DataPengukuran::where('id_balita', $balita->id)
                ->whereMonth('tanggal_pengukuran', $bulan)
                ->whereYear('tanggal_pengukuran', $tahun)
                ->first();

            $umur = PerhitunganUmur::hitungUmurBulanPenuh($balita->tanggal_lahir, $bulan, $tahun);

            return [
                'balita' => $balita,
                'pengukuran' => $pengukuran,
                'umur' => $umur,
                'status_verifikasi' => $pengukuran ? $pengukuran->status_verifikasi : null,
            ];
        });

        return view('pages.PetugasPosyandu.DataPengukuran.index', [
            'data_balitas' => $data_balitas,
            'balitas' => $balitas,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'search' => $search,
            'perPage' => $perPage,
        ]);
    }

    public function create($id_balita)
    {
        $user = Auth::user();
        $balita = Balita::findOrFail($id_balita);

        if ($user->id_posyandu !== $balita->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        $filterBulan = request()->input('bulan', Carbon::now()->month);
        $filterTahun = request()->input('tahun', Carbon::now()->year);

        // Hitung umur balita berdasarkan filter bulan dan tahun
        $umurBulan = PerhitunganUmur::hitungUmurBulanPenuh(
            $balita->tanggal_lahir,
            $filterBulan,
            $filterTahun
        );

        return view('pages.PetugasPosyandu.DataPengukuran.create', compact('balita', 'umurBulan', 'filterBulan', 'filterTahun'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_balita' => 'required|exists:balitas,id',
            'tanggal_pengukuran' => 'required|date',
            'usia_bulan' => 'required|integer|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'berat_badan' => 'required|numeric|min:0',
            'asi_ekslusif' => 'nullable|in:1,0',
            'mpasi' => 'nullable|in:1,2',
        ], [
            'id_balita.required' => 'ID balita harus diisi.',
            'id_balita.exists' => 'ID balita tidak ditemukan di database.',
            'tanggal_pengukuran.required' => 'Tanggal pengukuran harus diisi.',
            'tanggal_pengukuran.date' => 'Tanggal pengukuran harus berupa format tanggal yang valid.',
            'usia_bulan.required' => 'Usia bulan harus diisi.',
            'usia_bulan.integer' => 'Usia bulan harus berupa angka bulat.',
            'usia_bulan.min' => 'Usia bulan tidak boleh kurang dari 0.',
            'tinggi_badan.required' => 'Tinggi badan harus diisi.',
            'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
            'tinggi_badan.min' => 'Tinggi badan tidak boleh kurang dari 0.',
            'berat_badan.required' => 'Berat badan harus diisi.',
            'berat_badan.numeric' => 'Berat badan harus berupa angka.',
            'berat_badan.min' => 'Berat badan tidak boleh kurang dari 0.',
            'asi_ekslusif.in' => 'ASI eksklusif harus bernilai 1 atau 0.',
            'mpasi.in' => 'MPASI harus bernilai 1 atau 2.',
        ]);

        // Untuk verifikasi, nilai default
        $validatedData['status_verifikasi'] = 'to review';
        $validatedData['catatan'] = null;



        // Logika untuk mengatur nilai asi_ekslusif dan mpasi sesuai usia balita
        if ($validatedData['usia_bulan'] >= 0 && $validatedData['usia_bulan'] <= 6) {
            $validatedData['mpasi'] = null;
        } elseif ($validatedData['usia_bulan'] >= 6 && $validatedData['usia_bulan'] <= 23) {
            $validatedData['asi_ekslusif'] = null;
        } else {
            $validatedData['asi_ekslusif'] = null;
            $validatedData['mpasi'] = null;
        }

        // Proses Simpan data dengan db transaction
        DB::beginTransaction();

        try {
            // Simpan data pengukuran balita
            $pengukuran = DataPengukuran::create($validatedData);

            // Cari data balita terkait untuk mendapatkan jenis kelamin
            $balita = Balita::findOrFail($validatedData['id_balita']);

            $tinggi = $validatedData['tinggi_badan'];
            $berat = $validatedData['berat_badan'];
            $usiaBulan = $validatedData['usia_bulan'];

            if ($tinggi > 0 && $berat > 0) {
                $zscoreHelper = new PerhitunganZscore();

                // Hitung z-score Berat Badan per Umur
                $z_score_bb_u = $zscoreHelper->calculateZScoreBBU($berat, $usiaBulan, $balita->jenis_kelamin);
                // Hitung z-score Tinggi Badan per Umur
                $z_score_tb_u = $zscoreHelper->calculateZScoreTBU($tinggi, $usiaBulan, $balita->jenis_kelamin);
                // Hitung z-score Berat Badan per Tinggi Badan
                $z_score_bb_tb = $zscoreHelper->calculateZScoreBBTB($berat, $tinggi, $balita->jenis_kelamin);

                // Simpan data antropometri hasil perhitungan z-score
                $dataAntropometri = DataAntropometri::create([
                    'data_pengukuran_id' => $pengukuran->id,
                    'z_score_bb_u' => $z_score_bb_u,
                    'z_score_tb_u' => $z_score_tb_u,
                    'z_score_bb_tb' => $z_score_bb_tb,
                ]);

                // Simpan hasil screening berdasarkan z-score yang dihitung
                HasilScreening::create([
                    'data_antropometri_id' => $dataAntropometri->id,
                    'status_bb_u' => $zscoreHelper->getStatusBBU($z_score_bb_u) ?? '-',
                    'status_tb_u' => $zscoreHelper->getStatusTBU($z_score_tb_u) ?? '-',
                    'status_bb_tb' => $zscoreHelper->getStatusBBTB($z_score_bb_tb) ?? '-',
                    'status_stunting' => $zscoreHelper->getStatusStunting($z_score_tb_u) ?? '-',
                    'presentase_resiko_stunting' => $zscoreHelper->calculateRiskPercentage($z_score_tb_u) ?? 0,
                ]);
            }

            DB::commit();
            return redirect()->route('petugas-posyandu.data-pengukuran', [
                'bulan' => request('bulan'),
                'tahun' => request('tahun')
            ])->with('success', 'Data balita berhasil ditambahkan dan dihitung!');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = 'Gagal menyimpan data pengukuran. Silakan coba lagi.';
            return redirect()->route('petugas-posyandu.data-pengukuran', [
                'bulan' => request('bulan'),
                'tahun' => request('tahun')
            ])->with('error', $errorMessage);
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $id_posyandu = $user->id_posyandu;

        // Ambil data pengukuran 
        $pengukuran = DataPengukuran::with(['balita', 'dataAntropometri.hasilScreening'])->find($id);


        $balita = $pengukuran->balita;
        if (!$balita || $balita->id_posyandu !== $id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        return view('pages.PetugasPosyandu.DataPengukuran.show', compact('pengukuran'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $id_posyandu = $user->id_posyandu;

        $pengukuran = DataPengukuran::with('balita')->findOrFail($id);

        $balita = $pengukuran->balita;
        if (!$balita || $balita->id_posyandu !== $id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        $filterBulan = request()->input('bulan', Carbon::now()->month);
        $filterTahun = request()->input('tahun', Carbon::now()->year);

        // Hitung umur balita berdasarkan filter bulan dan tahun
        $umurBulan = PerhitunganUmur::hitungUmurBulanPenuh(
            $balita->tanggal_lahir,
            $filterBulan,
            $filterTahun
        );


        return view('pages.PetugasPosyandu.DataPengukuran.edit', compact('pengukuran', 'balita', 'umurBulan', 'filterBulan', 'filterTahun'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $pengukuran = DataPengukuran::with('balita')->findOrFail($id);
        $balita = $pengukuran->balita;

        if (!$balita || $balita->id_posyandu !== $user->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        $validatedData = $request->validate([
            'tanggal_pengukuran' => 'required|date',
            'usia_bulan' => 'required|integer|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'berat_badan' => 'required|numeric|min:0',
            'asi_ekslusif' => 'nullable|in:1,0',
            'mpasi' => 'nullable|in:1,2',
        ], [
            'tanggal_pengukuran.required' => 'Tanggal pengukuran harus diisi.',
            'tanggal_pengukuran.date' => 'Tanggal pengukuran harus berupa format tanggal yang valid.',
            'usia_bulan.required' => 'Usia bulan harus diisi.',
            'usia_bulan.integer' => 'Usia bulan harus berupa angka bulat.',
            'usia_bulan.min' => 'Usia bulan tidak boleh kurang dari 0.',
            'tinggi_badan.required' => 'Tinggi badan harus diisi.',
            'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
            'tinggi_badan.min' => 'Tinggi badan tidak boleh kurang dari 0.',
            'berat_badan.required' => 'Berat badan harus diisi.',
            'berat_badan.numeric' => 'Berat badan harus berupa angka.',
            'berat_badan.min' => 'Berat badan tidak boleh kurang dari 0.',
            'asi_ekslusif.in' => 'ASI eksklusif harus bernilai 1 atau 0.',
            'mpasi.in' => 'MPASI harus bernilai 1 atau 2.',
        ]);

        // Untuk verifikasi, nilai default
        $validatedData['status_verifikasi'] = 'to review';
        $validatedData['catatan'] = null;

        if ($validatedData['usia_bulan'] >= 0 && $validatedData['usia_bulan'] <= 6) {
            $validatedData['mpasi'] = null;
        } elseif ($validatedData['usia_bulan'] > 6 && $validatedData['usia_bulan'] <= 23) {
            $validatedData['asi_ekslusif'] = null;
        } else {
            $validatedData['asi_ekslusif'] = null;
            $validatedData['mpasi'] = null;
        }

        DB::beginTransaction();

        try {
            $pengukuran->update($validatedData);

            $tinggi = $validatedData['tinggi_badan'];
            $berat = $validatedData['berat_badan'];
            $usiaBulan = $validatedData['usia_bulan'];

            if ($tinggi > 0 && $berat > 0) {
                $zscoreHelper = new PerhitunganZscore();

                $z_score_bb_u = $zscoreHelper->calculateZScoreBBU($berat, $usiaBulan, $balita->jenis_kelamin);
                $z_score_tb_u = $zscoreHelper->calculateZScoreTBU($tinggi, $usiaBulan, $balita->jenis_kelamin);
                $z_score_bb_tb = $zscoreHelper->calculateZScoreBBTB($berat, $tinggi, $balita->jenis_kelamin);

                $dataAntropometri = DataAntropometri::where('data_pengukuran_id', $pengukuran->id)->first();
                if ($dataAntropometri) {
                    $dataAntropometri->update([
                        'z_score_bb_u' => $z_score_bb_u,
                        'z_score_tb_u' => $z_score_tb_u,
                        'z_score_bb_tb' => $z_score_bb_tb,
                    ]);
                }

                $hasilScreening = HasilScreening::where('data_antropometri_id', $dataAntropometri->id ?? 0)->first();
                if ($hasilScreening) {
                    $hasilScreening->update([
                        'status_bb_u' => $zscoreHelper->getStatusBBU($z_score_bb_u) ?? '-',
                        'status_tb_u' => $zscoreHelper->getStatusTBU($z_score_tb_u) ?? '-',
                        'status_bb_tb' => $zscoreHelper->getStatusBBTB($z_score_bb_tb) ?? '-',
                        'status_stunting' => $zscoreHelper->getStatusStunting($z_score_tb_u) ?? '-',
                        'presentase_resiko_stunting' => $zscoreHelper->calculateRiskPercentage($z_score_tb_u) ?? 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('petugas-posyandu.data-pengukuran')->with('success', 'Data pengukuran berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengukuran = DataPengukuran::findOrFail($id);
            $pengukuran->delete();

            return redirect()->back()
                ->with('success', 'Data pengukuran berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function download(Request $request)
    {
        $user = Auth::user();
        $posyandu = Posyandu::find($user->id_posyandu);

        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        $filename = 'File_Pengukuran_' . str_replace(' ', '_', $posyandu->nama_posyandu) . '_' . Carbon::now()->format('d-m-Y') . '.xlsx';

        return Excel::download(new DataPengukuranExport($bulan, $tahun, $user->id_posyandu), $filename);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'bulan' => 'required|numeric|min:1|max:12',
            'tahun' => 'required|numeric|min:2015',
        ]);

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $tanggal_pengukuran = Carbon::createFromDate($tahun, $bulan, 1)->format('Y-m-d');

        $import = (new DataPengukuranImport())
            ->setFilterBulanTahun($bulan, $tahun)
            ->setTanggalPengukuran($tanggal_pengukuran);

        try {
            Excel::import($import, $request->file('file'));

            $errors = $import->getErrors();
            if (count($errors) > 0) {
                // Kirim response json error dengan status 422 (validation error)
                return response()->json([
                    'message' => 'Terdapat beberapa kesalahan dalam file import',
                    'errors' => $errors
                ], 422);
            }

            // Kirim response json sukses
            return response()->json([
                'message' => 'Data pengukuran berhasil diimport'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengimport file: ' . $e->getMessage()
            ], 500);
        }
    }
}
