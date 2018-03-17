<?php

namespace App\Console;

use App\Console\Commands\AcatOnlineCrawler;
use App\Console\Commands\CatalogTypeCrawler;
use App\Console\Commands\CountriesCrawler;
use App\Console\Commands\CrawlerCommand;
use App\Console\Commands\ModelCrawler;
use App\Console\Commands\ModelCrawlerCommand;
use App\Console\Commands\ModelGroupYearCrawler;
use App\Console\Commands\SparePartCategoryCrawler;
use App\Console\Commands\SparePartCrawler;
use App\Console\Commands\SparePartGroupCrawler;
use App\Console\Commands\SparePartGroupImageCrawler;
use App\Console\Commands\SparePartGroupThumbnailCrawler;
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
        AcatOnlineCrawler::class,
        CatalogTypeCrawler::class,
        ModelCrawler::class,
        CountriesCrawler::class,
        ModelGroupYearCrawler::class,
        SparePartCategoryCrawler::class,
        SparePartGroupCrawler::class,
        SparePartCrawler::class,
        SparePartGroupThumbnailCrawler::class,
        SparePartGroupImageCrawler::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
