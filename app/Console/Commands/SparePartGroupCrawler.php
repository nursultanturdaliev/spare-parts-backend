<?php

namespace App\Console\Commands;


use App\SparePartCategory;
use App\SparePartGroup;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class SparePartGroupCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:spare-part-group';

    public function run(InputInterface $input, OutputInterface $output)
    {
        SparePartCategory::chunk(10, function ($sparePartCategories) use ($output) {
            /** @var SparePartCategory $sparePartCategory */
            foreach ($sparePartCategories as $sparePartCategory) {
                if($sparePartCategory->id< 218){
                    continue;
                }
                $crawler = new Crawler($sparePartCategory->content);
                $output->writeln('Starting SparePartCategory  - ' . $sparePartCategory->id);

                $crawler->filter('div.etka_groups>a')->each(function (Crawler $crawler) use ($output,$sparePartCategory) {
                    $href = $crawler->attr('href');
                    $thumbnailSrc = $crawler->filter('div.catalog--mark_image>img')->first()->attr('src');
                    $name = $crawler->filter('div.catalog--mark_description>div.catalog--mark_name')->first()->text();
                    $description = '';
                    try {
                        $description = $crawler->filter('div.catalog--mark_description>div.catalog--mark_modif')->first()->text();
                    } catch (\Exception $exception) {
                    }


                    $client = new Client();
                    $response = $client->get($this->domain . $href);
                    $content = $response->getBody()->getContents();

                    /** @var SparePartGroup $sparePartGroup */
                    $sparePartGroup = SparePartGroup::create([
                        'name' => $name,
                        'href' => $href,
                        'description' => $description,
                        'content' => $content,
                        'thumbnail_src' => $thumbnailSrc,
                        'spare_part_category_id'=>$sparePartCategory->id
                    ]);

                    $output->writeln('Spare Part Group - ' . $sparePartGroup->id . ' - ' . $sparePartGroup->name);

                });
            }
        });
    }

}