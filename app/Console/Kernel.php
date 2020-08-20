<?php

namespace App\Console;

use App\Console\Commands\CreateUser;
use App\Console\Commands\NewsLoadCommand;
use App\Console\Commands\NewsLoadSourcesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use Mlntn\Console\Commands\Serve;
use TCG\Voyager\Commands\InstallCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NewsLoadSourcesCommand::class,
        NewsLoadCommand::class,
        CreateUser::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
