<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 7:19 PM
 */

namespace App\Console\Commands;

use App\ModelGroupYear;
use App\SparePartCategory;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class SparePartCategoryCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:spare-part-category';

    public function run(InputInterface $input, OutputInterface $output)
    {
        ModelGroupYear::chunk(10, function ($modelGroupYears) use ($output) {
            /** @var ModelGroupYear $modelGroupYear */
            foreach ($modelGroupYears as $modelGroupYear) {
                if ($modelGroupYear->id < 373) {
                    continue;
                }

                $crawler = new Crawler($modelGroupYear->content);

                $output->writeln('ModelGroupYear: ' . $modelGroupYear->id . ' : ' . $modelGroupYear->name);

                $crawler->filter('div.etka_groups>a')->each(function (Crawler $crawler) use ($output, $modelGroupYear) {
                    $href = $crawler->attr('href');
                    $name = $crawler->filter('div.etka_group-name')->first()->text();
                    $src = $crawler->filter('div.etka_group-image>img')->first()->attr('src');

                    $client = new Client();
                    $response = $client->get($this->domain . $href);

                    $content = $response->getBody()->getContents();

                    $imageResponse = $client->get($src);

                    $thumbnail = $imageResponse->getBody()->getContents();

                    SparePartCategory::create([
                        'name'                => $name,
                        'thumbnail'           => $thumbnail,
                        'href'                => $href,
                        'content'             => $content,
                        'model_group_year_id' => $modelGroupYear->id,
                    ]);

                });

            }
        });
    }


}