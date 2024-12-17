<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-scheduled-notes')->timezone('Europe/Berlin')->dailyAt('09:00');
    }

    protected function commands()
    {
        // ...existing code...
    }
}
