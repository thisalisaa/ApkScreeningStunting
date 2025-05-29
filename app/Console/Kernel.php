<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar Artisan commands aplikasi Anda.
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        \App\Console\Commands\HitungRekapitulasiCommand::class,
    ];

    /**
     * Definisikan penjadwalan tugas di sini.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('rekapitulasi:hitung')->dailyAt('23:55');

    }

    /**
     * Daftarkan commands custom aplikasi.
     */
    protected function commands(): void
    {
        // Memuat commands dari routes/console.php
        $this->load(__DIR__.'/../routes/console.php');

        // Jika ada perintah artisan khusus di folder Commands
        // $this->load(__DIR__.'/Commands');
    }
}
