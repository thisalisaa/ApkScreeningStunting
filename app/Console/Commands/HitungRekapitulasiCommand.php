<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HitungRekapitulasiCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'rekapitulasi:hitung {bulan?} {tahun?}';

    /**
     * The console command description.
     */
    protected $description = 'Hitung rekapitulasi status gizi bulanan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bulan = $this->argument('bulan') ?: date('n', strtotime('last month'));
        $tahun = $this->argument('tahun') ?: date('Y', strtotime('last month'));

        $this->info("Menghitung rekapitulasi untuk bulan {$bulan} tahun {$tahun}...");

        try {
            // Cek apakah ada data screening untuk periode ini
            $jumlahData = DB::table('hasil_screenings')
                ->whereMonth('tanggal_screening', $bulan)
                ->whereYear('tanggal_screening', $tahun)
                ->count();

            if ($jumlahData == 0) {
                $this->warn("Tidak ada data screening untuk periode {$bulan}/{$tahun}");
                return Command::SUCCESS;
            }

            // Simpan atau update rekapitulasi ke tabel khusus (opsional)
            $this->simpanRekapitulasi($bulan, $tahun);

            $this->info("Rekapitulasi berhasil dihitung untuk periode {$bulan}/{$tahun}");
            $this->info("Total data yang diproses: {$jumlahData} record");

            Log::info("Rekapitulasi bulanan berhasil dihitung", [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jumlah_data' => $jumlahData
            ]);

        } catch (\Exception $e) {
            $this->error("Error saat menghitung rekapitulasi: " . $e->getMessage());
            Log::error("Error rekapitulasi bulanan", [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'error' => $e->getMessage()
            ]);
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    private function simpanRekapitulasi($bulan, $tahun)
    {
        // Hitung rekapitulasi status gizi
        $rekapitulasi = DB::table('hasil_screenings')
            ->join('balitas', 'hasil_screenings.balita_id', '=', 'balitas.id')
            ->whereMonth('hasil_screenings.tanggal_screening', $bulan)
            ->whereYear('hasil_screenings.tanggal_screening', $tahun)
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status_gizi = "stunting" THEN 1 ELSE 0 END) as stunting'),
                DB::raw('SUM(CASE WHEN status_gizi = "normal" THEN 1 ELSE 0 END) as normal'),
                DB::raw('SUM(CASE WHEN status_gizi = "beresiko" THEN 1 ELSE 0 END) as beresiko')
            )
            ->first();

        // Simpan ke tabel rekapitulasi_bulanan (buat tabel ini jika diperlukan)
        DB::table('rekapitulasi_bulanan')->updateOrInsert(
            [
                'bulan' => $bulan,
                'tahun' => $tahun
            ],
            [
                'total_balita' => $rekapitulasi->total,
                'jumlah_stunting' => $rekapitulasi->stunting,
                'jumlah_normal' => $rekapitulasi->normal,
                'jumlah_beresiko' => $rekapitulasi->beresiko,
                'persentase_stunting' => round(($rekapitulasi->stunting / $rekapitulasi->total) * 100, 2),
                'persentase_normal' => round(($rekapitulasi->normal / $rekapitulasi->total) * 100, 2),
                'persentase_beresiko' => round(($rekapitulasi->beresiko / $rekapitulasi->total) * 100, 2),
                'tanggal_hitung' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $this->line("Data rekapitulasi disimpan ke database");
    }
}