<?php

namespace App\Console;

use App\Console\Commands\AcatOnlineCrawler;
use App\Console\Commands\CatalogTypeCrawler;
use App\Console\Commands\CrawlerCommand;
use App\Console\Commands\ModelCrawlerCommand;
use App\Console\Commands\UpdateDesignations;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CrawlerCommand::class,
        ModelCrawlerCommand::class,
        UpdateDesignations::class,
        AcatOnlineCrawler::class,
        CatalogTypeCrawler::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
