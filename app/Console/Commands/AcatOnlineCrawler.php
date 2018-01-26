<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/21/18
 * Time: 1:55 PM
 */

namespace App\Console\Commands;


use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class AcatOnlineCrawler extends Command
{
    protected $name = 'app:acat';

    public function run(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $response = $client->get('https://acat.online/catalogs/CARS_FOREIGN/AUDI/RDW/A100/1985/58/R/group/0/011/269080');

        $content = $response->getBody()->getContents();

        $crawler = new Crawler($content);
        $title = $crawler->filter('h1.title')->first();
        $name = $title->text();

        $image = $crawler->filter('#imageLayout')->first();

        $imgHref = $image->filter('img')->first()->attr('src');
        $output->writeln($imgHref);

        $imageResponse = $client->get($imgHref);
        $output->writeln($imageResponse->getBody()->getContents());

        // Image content
        $output->writeln($image->html());

        $parts = $crawler->filter('.table-body>tr');

        $parts->each(function (Crawler $part, $index) use ($output) {
            $partInfo = [];
            $part->filter('td')->each(function (Crawler $property, $index) use ($output, &$partInfo) {
                $partInfo[$index] = $property;
            });

            $bakedInfo = [];

            $partInfoNote = $partInfo[1]->filter('.item-info-params');
            if ($partInfoNote->count() > 0) {
                $bakedInfo['note'] = $partInfoNote->text();
                $bakedInfo['note'] = str_replace('Примечание:', '', $bakedInfo['note']);
            }
            $bakedInfo['number'] = $partInfo[2]->text();
            $bakedInfo['description'] = $partInfo[3]->text();

            $output->writeln(implode($bakedInfo, ', '));
            $output->writeln('--------------------------------------------------------');
        });

    }

}