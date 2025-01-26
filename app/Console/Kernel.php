<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Tambahkan jadwal command artisan di sini, jika ada
        // Contoh: $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Daftarkan custom commands.
     */
    protected $commands = [
        \App\Console\Commands\MakeCustomWidget::class, // Tambahkan command custom Anda di sini
    ];
}
