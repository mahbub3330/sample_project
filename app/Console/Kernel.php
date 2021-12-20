<?php

namespace App\Console;

use App\Models\ScheduleOption;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $interval = DB::table((new ScheduleOption())->getTable())->first()->interval_option ?? 1;
        $expression = '*/' . $interval . ' * * * *';

        $schedule->command('schedule:test')->cron($expression);


//        $schedule->call(function () use ($interval){
//            info("called finally after" . $interval . " times");
//        })->cron($expression);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
