<?php

namespace App\Http\Controllers\PetugasPosyandu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));

        // Hitung rekapitulasi status gizi
        $rekapitulasi = $this->hitungRekapitulasiStatusGizi($bulan, $tahun);
        $detailPerIndikator = $this->hitungDetailPerIndikator($bulan, $tahun);
        $distribusiUmur = $this->hitungDistribusiUmur($bulan, $tahun);
        $distribusiJenisKelamin = $this->hitungDistribusiJenisKelamin($bulan, $tahun);

        return view('pages.PetugasPosyandu.Rekapitulasi.index', compact(
            'rekapitulasi',
            'detailPerIndikator',
            'distribusiUmur',
            'distribusiJenisKelamin',
            'bulan',
            'tahun'
        ));
    }

    private function hitungRekapitulasiStatusGizi($bulan, $tahun)
    {
        // Pastikan tabel 'hasil_screenings' punya kolom 'tanggal_screening' dan foreign key 'data_antropometri_id'
        // Kita join ke 'data_antropometris' lalu ke 'data_pengukurans' lalu ke 'balitas' untuk tanggal screening dan data balita

        $data = DB::table('hasil_screenings')
            ->join('data_antropometris', 'hasil_screenings.data_antropometri_id', '=', 'data_antropometris.id')
            ->join('data_pengukurans', 'data_antropometris.data_pengukuran_id', '=', 'data_pengukurans.id')
            ->join('balitas', 'data_pengukurans.id_balita', '=', 'balitas.id')
            ->whereMonth('data_pengukurans.tanggal_pengukuran', $bulan)
            ->whereYear('data_pengukurans.tanggal_pengukuran', $tahun)
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status_stunting = "stunting" THEN 1 ELSE 0 END) as stunting'),
                DB::raw('SUM(CASE WHEN status_stunting = "normal" THEN 1 ELSE 0 END) as normal'),
                DB::raw('SUM(CASE WHEN status_stunting = "beresiko" THEN 1 ELSE 0 END) as beresiko')
            )
            ->first();

        $total = $data->total ?: 1; // Hindari pembagian dengan nol

        return [
            'stunting' => [
                'jumlah' => $data->stunting,
                'persentase' => round(($data->stunting / $total) * 100, 2)
            ],
            'normal' => [
                'jumlah' => $data->normal,
                'persentase' => round(($data->normal / $total) * 100, 2)
            ],
            'beresiko' => [
                'jumlah' => $data->beresiko,
                'persentase' => round(($data->beresiko / $total) * 100, 2)
            ],
            'total' => $total
        ];
    }

    private function hitungDetailPerIndikator($bulan, $tahun)
    {
        $tbU = DB::table('hasil_screenings')
            ->join('data_antropometris', 'hasil_screenings.data_antropometri_id', '=', 'data_antropometris.id')
            ->join('data_pengukurans', 'data_antropometris.data_pengukuran_id', '=', 'data_pengukurans.id')
            ->join('balitas', 'data_pengukurans.id_balita', '=', 'balitas.id')
            ->whereMonth('data_pengukurans.tanggal_pengukuran', $bulan)
            ->whereYear('data_pengukurans.tanggal_pengukuran', $tahun)
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status_tb_u IN ("sangat pendek", "pendek") THEN 1 ELSE 0 END) as pendek'),
                DB::raw('SUM(CASE WHEN status_tb_u = "normal" THEN 1 ELSE 0 END) as normal')
            )
            ->first();

        $bbU = DB::table('hasil_screenings')
            ->join('data_antropometris', 'hasil_screenings.data_antropometri_id', '=', 'data_antropometris.id')
            ->join('data_pengukurans', 'data_antropometris.data_pengukuran_id', '=', 'data_pengukurans.id')
            ->join('balitas', 'data_pengukurans.id_balita', '=', 'balitas.id')
            ->whereMonth('data_pengukurans.tanggal_pengukuran', $bulan)
            ->whereYear('data_pengukurans.tanggal_pengukuran', $tahun)
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status_bb_u = "normal" THEN 1 ELSE 0 END) as normal'),
                DB::raw('SUM(CASE WHEN status_bb_u IN ("sangat kurang", "kurang") THEN 1 ELSE 0 END) as kurus')
            )
            ->first();

        return [
            'tb_u' => [
                'total' => $tbU->total ?? 0,
                'pendek' => $tbU->pendek ?? 0,
                'normal' => $tbU->normal ?? 0,
            ],
            'bb_u' => [
                'total' => $bbU->total ?? 0,
                'normal' => $bbU->normal ?? 0,
                'kurus' => $bbU->kurus ?? 0,
            ]
        ];
    }

    private function hitungDistribusiUmur($bulan, $tahun)
    {
        $data = DB::table('hasil_screenings')
            ->join('data_antropometris', 'hasil_screenings.data_antropometri_id', '=', 'data_antropometris.id')
            ->join('data_pengukurans', 'data_antropometris.data_pengukuran_id', '=', 'data_pengukurans.id')
            ->join('balitas', 'data_pengukurans.id_balita', '=', 'balitas.id')
            ->whereMonth('data_pengukurans.tanggal_pengukuran', $bulan)
            ->whereYear('data_pengukurans.tanggal_pengukuran', $tahun)
            ->select(
                'balitas.tanggal_lahir',
                'hasil_screenings.status_stunting',
                'data_pengukurans.tanggal_pengukuran'
            )
            ->get();

        $distribusi = [
            '0-6' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            '7-12' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            '13-24' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            '25-36' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            '37-48' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            '49-60' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
        ];

        foreach ($data as $item) {
            $umurBulan = $this->hitungUmurBulan($item->tanggal_lahir, $item->tanggal_pengukuran);
            $kategoriUmur = $this->getKategoriUmur($umurBulan);

            if (isset($distribusi[$kategoriUmur])) {
                $distribusi[$kategoriUmur]['total']++;
                $status = $item->status_stunting ?? 'normal';
                if (isset($distribusi[$kategoriUmur][$status])) {
                    $distribusi[$kategoriUmur][$status]++;
                }
            }
        }

        return $distribusi;
    }

    private function hitungDistribusiJenisKelamin($bulan, $tahun)
    {
        $data = DB::table('hasil_screenings')
            ->join('data_antropometris', 'hasil_screenings.data_antropometri_id', '=', 'data_antropometris.id')
            ->join('data_pengukurans', 'data_antropometris.data_pengukuran_id', '=', 'data_pengukurans.id')
            ->join('balitas', 'data_pengukurans.id_balita', '=', 'balitas.id')
            ->whereMonth('data_pengukurans.tanggal_pengukuran', $bulan)
            ->whereYear('data_pengukurans.tanggal_pengukuran', $tahun)
            ->select(
                'balitas.jenis_kelamin',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status_stunting = "stunting" THEN 1 ELSE 0 END) as stunting'),
                DB::raw('SUM(CASE WHEN status_stunting = "normal" THEN 1 ELSE 0 END) as normal'),
                DB::raw('SUM(CASE WHEN status_stunting = "beresiko" THEN 1 ELSE 0 END) as beresiko')
            )
            ->groupBy('balitas.jenis_kelamin')
            ->get();

        $distribusi = [
            'laki-laki' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0],
            'perempuan' => ['total' => 0, 'stunting' => 0, 'normal' => 0, 'beresiko' => 0]
        ];

        foreach ($data as $item) {
            $jk = strtolower($item->jenis_kelamin);
            if (isset($distribusi[$jk])) {
                $distribusi[$jk] = [
                    'total' => $item->total,
                    'stunting' => $item->stunting,
                    'normal' => $item->normal,
                    'beresiko' => $item->beresiko,
                ];
            }
        }

        return $distribusi;
    }

    private function hitungUmurBulan($tanggalLahir, $tanggalPengukuran)
    {
        $lahir = \Carbon\Carbon::parse($tanggalLahir);
        $ukur = \Carbon\Carbon::parse($tanggalPengukuran);
        return $lahir->diffInMonths($ukur);
    }

    private function getKategoriUmur($umurBulan)
    {
        if ($umurBulan >= 0 && $umurBulan <= 6) return '0-6';
        if ($umurBulan >= 7 && $umurBulan <= 12) return '7-12';
        if ($umurBulan >= 13 && $umurBulan <= 24) return '13-24';
        if ($umurBulan >= 25 && $umurBulan <= 36) return '25-36';
        if ($umurBulan >= 37 && $umurBulan <= 48) return '37-48';
        if ($umurBulan >= 49 && $umurBulan <= 60) return '49-60';
        return null;
    }
}
