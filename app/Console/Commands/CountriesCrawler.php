<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/26/18
 * Time: 9:30 PM
 */

namespace App\Console\Commands;


use App\Country;
use App\Manufacturer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CountriesCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:countries';

    public function run(InputInterface $input, OutputInterface $output)
    {
        Manufacturer::chunk(10, function ($manufacturers) use ($output) {
            /** @var Manufacturer $manufacturer */
            foreach ($manufacturers as $manufacturer) {
                $crawler = new Crawler($manufacturer->content);
                $crawler->filter('span.country')->each(function (Crawler $crawler) use ($output) {
                    $name = $crawler->text();
                    $code = $crawler->attr('data-country');
                    $output->writeln($name . ' : ' . $code);
                    Country::firstOrCreate(['name' => $name, 'code' => $code]);
                });
            }
        });
    }

}