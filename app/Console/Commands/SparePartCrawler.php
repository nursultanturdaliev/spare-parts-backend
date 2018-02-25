<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/25/18
 * Time: 10:36 PM
 */

namespace App\Console\Commands;


use App\SparePartGroup;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class SparePartCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:spare-part';

    public function run(InputInterface $input, OutputInterface $output)
    {
        SparePartGroup::chunk(10, function ($sparePartGroups) {
            /** @var SparePartGroup $sparePartGroup */
            foreach ($sparePartGroups as $sparePartGroup) {
                $crawler = new Crawler($sparePartGroup->content);
            }
        });
    }
}