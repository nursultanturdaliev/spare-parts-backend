<?php
/**
 * Created by PhpStorm.
 * User: suior
 * Date: 04.03.2018
 * Time: 15:52
 */

namespace App\Console\Commands;


use App\SparePartGroup;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SparePartGroupThumbnailCrawler extends BaseAcatCommand
{
    protected $name="acat:crawler:spare-part-group:thumbnail";

    public function run(InputInterface $input, OutputInterface $output)
    {
        SparePartGroup::chunk(10, function ($sparePartGroups) use ($output) {
            /** @var SparePartGroup $sparePartGroup */
            foreach ($sparePartGroups as $sparePartGroup) {

                $newSparePartGroup = SparePartGroup::find($sparePartGroup->id);

                if ($newSparePartGroup->thumbnail) {
                    $output->writeln("continue");
                    continue;
                }
                try{
                    $src = $sparePartGroup->thumbnail_src;
                    $client = new Client();
                    $imageResponse = $client->get($src);
                    $thumbnail = $imageResponse->getBody()->getContents();

                    SparePartGroup::where("thumbnail_src", "=", $src)->update(["thumbnail" => $thumbnail]);

                    $output->writeln("Updated: " .$src );
                }catch (RequestException $requestException){
                    $output->writeln("Undefined");
                }
            }
        });
    }

}