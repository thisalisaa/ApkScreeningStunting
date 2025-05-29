<?php

namespace App\Http\Controllers\PetugasPosyandu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\DataKesehatan;

class DataBalitaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Balita::query();

        // Menampilkan data balita sesuai id_posyandu
        if ($user->role === 'petugas_posyandu') {
            $query->where('id_posyandu', $user->id_posyandu);
        }

        // Filter berdasarkan jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Pencarian berdasarkan nama balita, alamat, atau nama orang tua
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_balita', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->orWhereHas('orangTua', function ($q2) use ($search) {
                        $q2->where('nama_ayah', 'like', "%$search%")
                            ->orWhere('nama_ibu', 'like', "%$search%");
                    });
            });
        }

        $query->orderBy('nama_balita', 'asc');
        $perPage = $request->input('per_page', 5);
        $balitas = $query->with(['orangTua', 'posyandu'])->paginate($perPage)->appends($request->query());

        return view('pages.PetugasPosyandu.DataBalita.index', compact('balitas'));
    }

    public function create()
    {
        return view('pages.PetugasPosyandu.DataBalita.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            // Data Balita
            'nama_balita' => 'required|string|max:100',
            'nik_balita' => 'required|numeric|digits:16|unique:balitas,nik_balita',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'berat_badan_lahir' => 'required|numeric',
            'panjang_badan_lahir' => 'required|numeric',
            'alamat' => 'required|string|max:255',

            // Data Orang Tua
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:12',
            'pekerjaan_ayah' => 'required|string|max:50',
            'pekerjaan_ibu' => 'required|string|max:50',
            'pendidikan_ayah' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Perguruan Tinggi',
            'pendidikan_ibu' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Perguruan Tinggi',
            'tinggi_badan_ayah' => 'required|numeric',
            'tinggi_badan_ibu' => 'required|numeric',
            'pendapatan_keluarga' => 'required|string|max:50',

            // Data Kesehatan
            'riwayat_penyakit' => 'required|in:Ya,Tidak',
            'keterangan_riwayat_penyakit' => 'nullable|required_if:keterangan_riwayat_penyakit,Ya|string|max:255',
            'alergi' => 'required|in:Ya,Tidak',
            'keterangan_alergi' => 'nullable|required_if:keterangan_alergi,Ya|string|max:255',
            'bebas_asap_rokok' => 'required|in:Ya,Tidak',
            'sumber_air_bersih' => 'required|in:Tersedia,Tidak Tersedia',
        ], [

            // Data Balita
            'nama_balita.required' => 'Nama balita harus diisi',
            'nama_balita.string' => 'Nama balita harus berupa teks',
            'nama_balita.max' => 'Nama balita tidak boleh lebih dari 100 karakter',

            'nik_balita.required' => 'NIK balita harus diisi',
            'nik_balita.numeric' => 'NIK balita harus berupa angka',
            'nik_balita.digits' => 'NIK balita harus terdiri dari 16 digit',
            'nik_balita.unique' => 'NIK balita sudah terdaftar dalam sistem',

            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa teks',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter',

            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',

            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',

            'berat_badan_lahir.required' => 'Berat badan lahir harus diisi',
            'berat_badan_lahir.numeric' => 'Berat badan lahir harus berupa angka',

            'panjang_badan_lahir.required' => 'Panjang badan lahir harus diisi',
            'panjang_badan_lahir.numeric' => 'Panjang badan lahir harus berupa angka',

            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa teks',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter',

            // Data Orang Tua
            'nama_ayah.required' => 'Nama ayah harus diisi',
            'nama_ayah.string' => 'Nama ayah harus berupa teks',
            'nama_ayah.max' => 'Nama ayah tidak boleh lebih dari 100 karakter',

            'nama_ibu.required' => 'Nama ibu harus diisi',
            'nama_ibu.string' => 'Nama ibu harus berupa teks',
            'nama_ibu.max' => 'Nama ibu tidak boleh lebih dari 100 karakter',

            'no_telepon.required' => 'Nomor telepon harus diisi',
            'no_telepon.string' => 'Nomor telepon harus berupa teks',
            'no_telepon.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter',

            'pekerjaan_ayah.required' => 'Pekerjaan ayah harus diisi',
            'pekerjaan_ayah.string' => 'Pekerjaan ayah harus berupa teks',
            'pekerjaan_ayah.max' => 'Pekerjaan ayah tidak boleh lebih dari 50 karakter',

            'pekerjaan_ibu.required' => 'Pekerjaan ibu harus diisi',
            'pekerjaan_ibu.string' => 'Pekerjaan ibu harus berupa teks',
            'pekerjaan_ibu.max' => 'Pekerjaan ibu tidak boleh lebih dari 50 karakter',

            'pendidikan_ayah.required' => 'Pendidikan ayah harus dipilih',
            'pendidikan_ayah.in' => 'Pilihan pendidikan ayah tidak valid',

            'pendidikan_ibu.required' => 'Pendidikan ibu harus dipilih',
            'pendidikan_ibu.in' => 'Pilihan pendidikan ibu tidak valid',

            'tinggi_badan_ayah.required' => 'Tinggi badan ayah harus diisi',
            'tinggi_badan_ayah.numeric' => 'Tinggi badan ayah harus berupa angka',

            'tinggi_badan_ibu.required' => 'Tinggi badan ibu harus diisi',
            'tinggi_badan_ibu.numeric' => 'Tinggi badan ibu harus berupa angka',

            'pendapatan_keluarga.required' => 'Pendapatan keluarga harus diisi',
            'pendapatan_keluarga.string' => 'Pendapatan keluarga harus berupa teks',
            'pendapatan_keluarga.max' => 'Pendapatan keluarga tidak boleh lebih dari 50 karakter',

            // Data Kesehatan
            'riwayat_penyakit.required' => 'Status riwayat penyakit harus diisi',
            'riwayat_penyakit.in' => 'Status riwayat penyakit tidak valid',

            'keterangan_riwayat_penyakit.required_if' => 'Keterangan riwayat penyakit harus diisi jika pernah mengalami riwayat penyakit',
            'keterangan_riwayat_penyakit.string' => 'Keterangan riwayat penyakit harus berupa teks',
            'keterangan_riwayat_penyakit.max' => 'Keterangan riwayat penyakit tidak boleh lebih dari 255 karakter',

            'alergi.required' => 'Status alergi harus diisi',
            'alergi.in' => 'Status alergi tidak valid',

            'keterangan_alergi.required_if' => 'Keterangan alergi harus diisi jika anak memiliki alergi',
            'keterangan_alergi.string' => 'Keterangan alergi harus berupa teks',
            'keterangan_alergi.max' => 'Keterangan alergi tidak boleh lebih dari 255 karakter',

            'bebas_asap_rokok.required' => 'Status bebas asap rokok harus diisi',
            'bebas_asap_rokok.in' => 'Status bebas asap rokok tidak valid',

            'sumber_air_bersih.required' => 'Ketersediaan sumber air bersih harus diisi',
            'sumber_air_bersih.in' => 'Status sumber air bersih tidak valid',
        ]);

        // Proses Store dengan DB Transaction
        DB::beginTransaction();
        try {
            // 1. Simpan data orang tua 
            $orangTua = OrangTua::create([
                'nama_ayah' => $validatedData['nama_ayah'],
                'nama_ibu' => $validatedData['nama_ibu'],
                'no_telepon' => $validatedData['no_telepon'],
                'pekerjaan_ayah' => $validatedData['pekerjaan_ayah'],
                'pekerjaan_ibu' => $validatedData['pekerjaan_ibu'],
                'pendidikan_ayah' => $validatedData['pendidikan_ayah'],
                'pendidikan_ibu' => $validatedData['pendidikan_ibu'],
                'tinggi_badan_ayah' => $validatedData['tinggi_badan_ayah'],
                'tinggi_badan_ibu' => $validatedData['tinggi_badan_ibu'],
                'pendapatan_keluarga' => $validatedData['pendapatan_keluarga'],
            ]);

            // 2. Simpan data balita dengan relasi ke orang tua
            $user = Auth::user();
            $posyandu_id = $user->id_posyandu;

            $balita = Balita::create([
                'id_orang_tua' => $orangTua->id,
                'id_posyandu' => $posyandu_id,
                'nama_balita' => $validatedData['nama_balita'],
                'nik_balita' => $validatedData['nik_balita'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'alamat' => $validatedData['alamat'],
                'berat_badan_lahir' => $validatedData['berat_badan_lahir'],
                'panjang_badan_lahir' => $validatedData['panjang_badan_lahir'],
            ]);

            // 3. Simpan data kesehatan
            $dataKesehatan = DataKesehatan::create([
                'id_balita' => $balita->id,
                'riwayat_penyakit' => $validatedData['riwayat_penyakit'],
                'keterangan_riwayat_penyakit' => $validatedData['keterangan_riwayat_penyakit'] ?? null,
                'alergi' => $validatedData['alergi'],
                'keterangan_alergi' => $validatedData['keterangan_alergi'] ?? null,
                'bebas_asap_rokok' => $validatedData['bebas_asap_rokok'],
                'sumber_air_bersih' => $validatedData['sumber_air_bersih'],
            ]);

            DB::commit();

            return redirect()->route('petugas.data-balita')
                ->with('success', 'Data balita berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $balita = Balita::with(['orangTua', 'dataKesehatan'])->findOrFail($id);

        if ($user->id_posyandu !== $balita->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        return view('pages.PetugasPosyandu.DataBalita.show', compact('balita'));
    }


    public function edit(string $id)
    {
        $user = Auth::user();
        $balita = Balita::with(['orangTua', 'dataKesehatan'])->findOrFail($id);

        if ($user->id_posyandu !== $balita->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        return view('pages.PetugasPosyandu.DataBalita.edit', compact('balita'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $balita = Balita::with(['orangTua', 'dataKesehatan'])->findOrFail($id);

        if ($user->id_posyandu !== $balita->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        $validatedData = $request->validate([
            // Data Balita
            'nama_balita' => 'required|string|max:100',
            'nik_balita' => 'required|numeric|digits:16|unique:balitas,nik_balita,' . $id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'berat_badan_lahir' => 'required|numeric',
            'panjang_badan_lahir' => 'required|numeric',
            'alamat' => 'required|string|max:255',

            // Data Orang Tua
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:12',
            'pekerjaan_ayah' => 'required|string|max:50',
            'pekerjaan_ibu' => 'required|string|max:50',
            'pendidikan_ayah' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Perguruan Tinggi',
            'pendidikan_ibu' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Perguruan Tinggi',
            'tinggi_badan_ayah' => 'required|numeric',
            'tinggi_badan_ibu' => 'required|numeric',
            'pendapatan_keluarga' => 'required|string|max:50',

            // Data Kesehatan
            'riwayat_penyakit' => 'required|in:Ya,Tidak',
            'keterangan_riwayat_penyakit' => 'nullable|required_if:riwayat_penyakit,Ya|string|max:255',
            'alergi' => 'required|in:Ya,Tidak',
            'keterangan_alergi' => 'nullable|required_if:alergi,Ya|string|max:255',
            'bebas_asap_rokok' => 'required|in:Ya,Tidak',
            'sumber_air_bersih' => 'required|in:Tersedia,Tidak Tersedia',
        ], [

            // Data Balita
            'nama_balita.required' => 'Nama balita harus diisi',
            'nama_balita.string' => 'Nama balita harus berupa teks',
            'nama_balita.max' => 'Nama balita tidak boleh lebih dari 100 karakter',

            'nik_balita.required' => 'NIK balita harus diisi',
            'nik_balita.numeric' => 'NIK balita harus berupa angka',
            'nik_balita.digits' => 'NIK balita harus terdiri dari 16 digit',
            'nik_balita.unique' => 'NIK balita sudah terdaftar dalam sistem',

            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa teks',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter',

            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',

            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',

            'berat_badan_lahir.required' => 'Berat badan lahir harus diisi',
            'berat_badan_lahir.numeric' => 'Berat badan lahir harus berupa angka',

            'panjang_badan_lahir.required' => 'Panjang badan lahir harus diisi',
            'panjang_badan_lahir.numeric' => 'Panjang badan lahir harus berupa angka',

            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa teks',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter',

            // Data Orang Tua
            'nama_ayah.required' => 'Nama ayah harus diisi',
            'nama_ayah.string' => 'Nama ayah harus berupa teks',
            'nama_ayah.max' => 'Nama ayah tidak boleh lebih dari 100 karakter',

            'nama_ibu.required' => 'Nama ibu harus diisi',
            'nama_ibu.string' => 'Nama ibu harus berupa teks',
            'nama_ibu.max' => 'Nama ibu tidak boleh lebih dari 100 karakter',

            'no_telepon.required' => 'Nomor telepon harus diisi',
            'no_telepon.string' => 'Nomor telepon harus berupa teks',
            'no_telepon.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter',

            'pekerjaan_ayah.required' => 'Pekerjaan ayah harus diisi',
            'pekerjaan_ayah.string' => 'Pekerjaan ayah harus berupa teks',
            'pekerjaan_ayah.max' => 'Pekerjaan ayah tidak boleh lebih dari 50 karakter',

            'pekerjaan_ibu.required' => 'Pekerjaan ibu harus diisi',
            'pekerjaan_ibu.string' => 'Pekerjaan ibu harus berupa teks',
            'pekerjaan_ibu.max' => 'Pekerjaan ibu tidak boleh lebih dari 50 karakter',

            'pendidikan_ayah.required' => 'Pendidikan ayah harus dipilih',
            'pendidikan_ayah.in' => 'Pilihan pendidikan ayah tidak valid',

            'pendidikan_ibu.required' => 'Pendidikan ibu harus dipilih',
            'pendidikan_ibu.in' => 'Pilihan pendidikan ibu tidak valid',

            'tinggi_badan_ayah.required' => 'Tinggi badan ayah harus diisi',
            'tinggi_badan_ayah.numeric' => 'Tinggi badan ayah harus berupa angka',

            'tinggi_badan_ibu.required' => 'Tinggi badan ibu harus diisi',
            'tinggi_badan_ibu.numeric' => 'Tinggi badan ibu harus berupa angka',

            'pendapatan_keluarga.required' => 'Pendapatan keluarga harus diisi',
            'pendapatan_keluarga.string' => 'Pendapatan keluarga harus berupa teks',
            'pendapatan_keluarga.max' => 'Pendapatan keluarga tidak boleh lebih dari 50 karakter',

            // Data Kesehatan
            'riwayat_penyakit.required' => 'Status riwayat penyakit harus diisi',
            'riwayat_penyakit.in' => 'Status riwayat penyakit tidak valid',

            'keterangan_riwayat_penyakit.required_if' => 'Keterangan riwayat penyakit harus diisi jika pernah mengalami riwayat penyakit',
            'keterangan_riwayat_penyakit.string' => 'Keterangan riwayat penyakit harus berupa teks',
            'keterangan_riwayat_penyakit.max' => 'Keterangan riwayat penyakit tidak boleh lebih dari 255 karakter',

            'alergi.required' => 'Status alergi harus diisi',
            'alergi.in' => 'Status alergi tidak valid',

            'keterangan_alergi.required_if' => 'Keterangan alergi harus diisi jika anak memiliki alergi',
            'keterangan_alergi.string' => 'Keterangan alergi harus berupa teks',
            'keterangan_alergi.max' => 'Keterangan alergi tidak boleh lebih dari 255 karakter',

            'bebas_asap_rokok.required' => 'Status bebas asap rokok harus diisi',
            'bebas_asap_rokok.in' => 'Status bebas asap rokok tidak valid',

            'sumber_air_bersih.required' => 'Ketersediaan sumber air bersih harus diisi',
            'sumber_air_bersih.in' => 'Status sumber air bersih tidak valid',
        ]);

        // Proses Update data dengan DB Transaction
        DB::beginTransaction();
        try {
            // Update data Orang Tua
            $balita->orangTua->update([
                'nama_ayah' => $validatedData['nama_ayah'],
                'nama_ibu' => $validatedData['nama_ibu'],
                'no_telepon' => $validatedData['no_telepon'],
                'pekerjaan_ayah' => $validatedData['pekerjaan_ayah'],
                'pekerjaan_ibu' => $validatedData['pekerjaan_ibu'],
                'pendidikan_ayah' => $validatedData['pendidikan_ayah'],
                'pendidikan_ibu' => $validatedData['pendidikan_ibu'],
                'tinggi_badan_ayah' => $validatedData['tinggi_badan_ayah'],
                'tinggi_badan_ibu' => $validatedData['tinggi_badan_ibu'],
                'pendapatan_keluarga' => $validatedData['pendapatan_keluarga'],
            ]);

            // Update data Balita
            $balita->update([
                'nama_balita' => $validatedData['nama_balita'],
                'nik_balita' => $validatedData['nik_balita'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'berat_badan_lahir' => $validatedData['berat_badan_lahir'],
                'panjang_badan_lahir' => $validatedData['panjang_badan_lahir'],
                'alamat' => $validatedData['alamat'],
            ]);

            // Update Data Kesehatan
            if ($balita->dataKesehatan) {
                $balita->dataKesehatan->update([
                    'riwayat_penyakit' => $validatedData['riwayat_penyakit'],
                    'keterangan_riwayat_penyakit' => $validatedData['keterangan_riwayat_penyakit'] ?? null,
                    'alergi' => $validatedData['alergi'],
                    'keterangan_alergi' => $validatedData['keterangan_alergi'] ?? null,
                    'bebas_asap_rokok' => $validatedData['bebas_asap_rokok'],
                    'sumber_air_bersih' => $validatedData['sumber_air_bersih'],
                ]);
            }
            DB::commit();

            return redirect()->route('petugas.data-balita')
                ->with('success', 'Data balita berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $balita = Balita::with(['orangTua', 'dataKesehatan'])->findOrFail($id);

            if ($user->id_posyandu !== $balita->id_posyandu) {
                abort(403, 'Anda tidak memiliki akses ke balita ini.');
            }

            // Hapus data kesehatan terlebih dahulu (ada id_balita)
            if ($balita->dataKesehatan) {
                $balita->dataKesehatan->delete();
            }

            // Hapus data orang tua
            if ($balita->orangTua) {
                $balita->orangTua->delete();
            }

            // Hapus data balita
            $balita->delete();

            DB::commit();
            return redirect()->route('petugas.data-balita')->with('success', 'Data balita berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function downlodBiodata($id)
    {
        $user = Auth::user();

        $balita = Balita::with(['orangTua', 'dataKesehatan'])->findOrFail($id);

        if ($user->id_posyandu !== $balita->id_posyandu) {
            abort(403, 'Anda tidak memiliki akses ke balita ini.');
        }

        $pdf = PDF::loadView('pages.PetugasPosyandu.DataBalita.pdf', compact('balita'));

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Biodata-' . $balita->nama_balita . '.pdf');
    }
}
