<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Jadwal perintah untuk notifikasi jatuh tempo setiap tanggal 10 pukul 00:00
        $schedule->command('notifikasi:jatuh-tempo')
                 ->monthlyOn(10, '00:00');

        // Contoh jadwal tambahan (jika diperlukan)
        // $schedule->call([PembayaranController::class, 'kirimPengingat'])->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
