<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\CheckCycleBill::class,
        \App\Console\Commands\SendBillNotice::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //TODO Need to add cron config example: * * * * * php /project_path/baiyu-daizhang/app/artisan schedule:run 1>> /dev/null 2>&1

        $schedule->command('check-cycle-bill')
            ->dailyAt(Config::get('app.time_check_cycle_bill'));

        $schedule->command('send-bill-notice')
            ->dailyAt(Config::get('app.time_send_bill_notice'));
    }
}
