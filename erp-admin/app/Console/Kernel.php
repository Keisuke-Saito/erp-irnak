<?php

namespace App\Console;

use App\Console\Batch;
use App\Console\Commands;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // コマンド
        Commands\MakeModelCommand::class,
        Commands\MakeServiceCommand::class,
        // バッチ
        Batch\Example\MessageBatch::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 毎日深夜１２時に実行
        $schedule->command('batch:message_batch')
                ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Batch');
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
