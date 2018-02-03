<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/26/18
 * Time: 9:30 PM
 */

namespace App\Console\Commands;


use App\CatalogType;
use App\Country;
use App\Manufacturer;
use App\ModelGroup;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ModelCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:model';

    public function run(InputInterface $input, OutputInterface $output)
    {

        $manufacturers = Manufacturer::all();
        /** @var Manufacturer $manufacturer */
        foreach ($manufacturers as $manufacturer) {
            $outerCrawler = new Crawler($manufacturer->content);

            $countries = Country::all();

            $countryMap = [];
            $outerCrawler->filter('.country')->each(function (Crawler $crawler, $index) use (&$countryMap) {
                $country = $crawler->attr('data-country');
                $countryMap[$country] = $index;
            });

            if (sizeof($countryMap) < 1) {
                continue;
            }

            $output->writeln($manufacturer->name);

            /** @var Country $country */
            foreach ($countries as $country) {
                $node = $outerCrawler->filter('table[data-countryid="' . $country->code . '"]')->first();
                if (!$node->count()) {
                    $output->writeln('NOT FOUND - COUNTRY - ' . $country->name);
                    continue;
                }

                $output->writeln('CRAWLING COUNTRY - ' . $country->name);

                $node->filter('tbody>tr')->each(function (Crawler $crawler, $index) use ($output, $manufacturer, $country, $countryMap, $outerCrawler) {

                    if ($index > 0) {
                        $modelGroupArray = [];
                        $keys = ['name', 'code', 'period', 'production'];
                        $crawler->filter('td')->each(function (Crawler $crawler, $index) use (&$modelGroupArray, $keys, $output) {
                            $modelGroupArray[$keys[$index]] = $crawler->text();
                        });

                        if (sizeof($modelGroupArray) == 4 && trim($modelGroupArray['name']) !== 'Рубрика') {
                            $modelGroupArray['manufacturer_id'] = $manufacturer->id;
                            $modelGroupArray['country_id'] = $country->id;


                            $countryIndex = $countryMap[$country->code];

                            $modal = $outerCrawler->filter('div[data-modal_year="' . $countryIndex . '-' . $modelGroupArray['name'] . '"]');

                            if (!$modal->count()) {
                                $output->writeln($countryIndex . ' : ' . $modelGroupArray['name']);

                            } else {
                                $modelGroupArray['years_content'] = $modal->first()->html();
                            }

                            ModelGroup::create($modelGroupArray);
                        }
                    }

                });
            }
        }
    }

}