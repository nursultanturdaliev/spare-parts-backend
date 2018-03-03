<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/25/18
 * Time: 10:36 PM
 */

namespace App\Console\Commands;


use App\SparePart;
use App\SparePartGroup;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class SparePartCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:spare-part';

    public function run(InputInterface $input, OutputInterface $output)
    {
        SparePartGroup::chunk(10, function ($sparePartGroups) use ($output) {
            /** @var SparePartGroup $sparePartGroup */
            foreach ($sparePartGroups as $sparePartGroup) {
                $crawler = new Crawler($sparePartGroup->content);

                $imageHtml = $crawler->filter('div.image-area')->first()->html();
                $imageSrc = $crawler->filter('div#imageLayout>img')->attr('src');
                $sparePartGroup->image_html = $imageHtml;
                $sparePartGroup->image_src = $imageSrc;
                $sparePartGroup->save();

                $crawler->filter('table>tbody.table-body>tr')->each(function (Crawler $crawler) use ($output, $sparePartGroup) {
                    $number = $crawler->filter('td:nth-child(1)')->text();
                    $name = $crawler->filter('td:nth-child(3)')->text();
                    $description = $crawler->filter('td:nth-child(4)')->text();

                    $sparePart = SparePart::create([
                        'number'=>$number,
                        'name'=>$name,
                        'description'=>$description,
                        'spare_part_group_id'=>$sparePartGroup->id
                    ]);

                    $output->writeln('ID: '. $sparePart->id .' - ' . $number . ' - ' . $name . ' - ' . $description);
                });
            }
        });
    }
}