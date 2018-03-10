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

class SparePartGroupImageCrawler extends BaseAcatCommand
{
    protected $name="acat:crawler:spare-part-group:image";

    public function run(InputInterface $input, OutputInterface $output)
    {
        SparePartGroup::chunk(100, function ($sparePartGroups) use ($output) {
            /** @var SparePartGroup $sparePartGroup */
            foreach ($sparePartGroups as $sparePartGroup) {


                $newSparePartGroup = SparePartGroup::find($sparePartGroup->id);

                if ($newSparePartGroup->image) {
                    $output->writeln("continue");
                    continue;
                }
                try {
                    $src = $sparePartGroup->image_src;
                    $client = new Client();
                    $imageResponse = $client->get($src);
                    $image = $imageResponse->getBody()->getContents();

                    SparePartGroup::where("image_src", "=", $src)->update(["image" => $image]);

                    $output->writeln("Updated: " . $src);
                } catch (RequestException $requestException) {
                    $output->writeln("Undefined");
                }
            }
        });
    }

}