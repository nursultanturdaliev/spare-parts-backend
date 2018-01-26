<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/26/18
 * Time: 9:30 PM
 */

namespace App\Console\Commands;


use App\CatalogType;
use App\Manufacturer;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CatalogTypeCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:catalog';

    public function run(InputInterface $input, OutputInterface $output)
    {
        /** @var CatalogType $catalogType */
        $catalogType = CatalogType::find(2);

        $crawler = new Crawler($catalogType->content);
        $marks = $crawler
            ->filter('div.marks-inline')
            ->first()
            ->filter('a')
            ->each(function (Crawler $crawler) use ($output) {

                $guzzle = new Client();

                $href = $crawler->attr('href');
                $name = $crawler->filter('div.main_catalog--mark_name')->text();

                $src = $crawler->filter('div.main_catalog--mark_image>img')->first()->attr('src');
                $thumbnail = $guzzle->get($src)->getBody()->getContents();

                $content = $guzzle->get($this->domain . $href)->getBody()->getContents();

                $output->writeln($href);
                $output->writeln($src);
                $output->writeln($name);

                /** @var Manufacturer $manufacturer */
                $manufacturer = Manufacturer::firstOrCreate(['name'      => $name,
                                             'href'      => $href,
                                             'thumbnail' => $thumbnail,
                                             'content'   => $content]);

                $output->writeln($manufacturer->name);

            });
    }

}