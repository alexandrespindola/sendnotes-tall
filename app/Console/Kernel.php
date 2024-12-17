<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // ...existing code...

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:send-scheduled-notes')->timezone('Europe/Berlin')->dailyAt('09:00');
    }

    protected function commands()
    {
        // ...existing code...
    }
}
