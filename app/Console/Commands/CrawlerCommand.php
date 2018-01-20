<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/15/18
 * Time: 11:22 PM
 */

namespace App\Console\Commands;

use App\Manufacturer;
use App\ManufacturerModel;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerCommand extends BaseCrawlerCommand
{
    protected $name = 'app:crawl';

    public function run(InputInterface $input, OutputInterface $output)
    {

        //$this->crawlManufacturers($output);
        //$this->saveManufacturerContents($output);
        $this->saveModels($output);

    }

    /**
     * @param OutputInterface $output
     * @param $guzzleClient
     */
    private function crawlManufacturers(OutputInterface $output): void
    {
        $guzzleClient = new Client();
        $response = $guzzleClient->request('GET', $this->hostname . '/Catalog/Global/Cars');

        $output->writeln($response->getStatusCode());

        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);
        $crawler->filter('.top-r div ul li a')->each(function (Crawler $li, $index) use ($output) {
            $href = $li->attr('href');
            $text = $li->text();

            /** @var Manufacturer $manufacturer */
            $manufacturer = Manufacturer::where('href', $href)->where('name', $text)->first();

            if (is_null($manufacturer)) {
                $manufacturer = Manufacturer::create(['href' => $href, 'name' => $text]);
                $manufacturer->save();
            } else {
                $output->writeln('[Manufacturer] Already inserted');
            }
        });
    }

    private function saveManufacturerContents(OutputInterface $output): void
    {
        $guzzle = new Client();

        /** @var Manufacturer $manufacturer */
        foreach (Manufacturer::all() as $manufacturer) {
            $url = $this->hostname . $manufacturer->href . '?all=1';
            $output->writeln("Crawling: $url");
            $response = $guzzle->request('GET', $url);

            $content = $response->getBody()->getContents();
            $manufacturer->content = $content;
            $manufacturer->save();
        };
    }

    private function saveModels(OutputInterface $output)
    {
        $guzzle = new Client();

        //$manufacturer = Manufacturer::where('name','BMW')->first();

        /** @var Manufacturer $manufacturer */
        foreach (Manufacturer::all() as $manufacturer) {
            $crawler = new Crawler($manufacturer->content);

            $crawler->filter('#models>.cell2')->each(function (Crawler $div, $index) use ($output, $guzzle, $manufacturer) {
                $name = $div->filter('.car-info__car-name> a')->first()->text();
                $href = $div->filter('.car-info__car-name > a')->first()->attr('href');

                $code = $div->filter('.car-info__car-models')->first()->text();

                $years = $div->filter('.car-info__car-years')->first()->html();
                $years = strip_tags($years);

                $imgHtml = $div->filter('.car-info__car-image')->html();
                $imgCrawler = new Crawler($imgHtml);

                $imageHref = $imgCrawler->filter('img')->first()->attr('lazyurl');
                $response = $guzzle->request('GET', 'https:' . $imageHref);
                $content = $response->getBody()->getContents();


                $manufacturerModel = ManufacturerModel::create([
                    'name' => $name,
                    'href' => $href,
                    'thumbnail' => $content,
                    'code' => $code,
                    'manufactured_years' => $years,
                    'manufacturer_id'=>$manufacturer->id
                ]);

                $manufacturerModel->save();

                $output->writeln($name . ' ' . $href . ' ' . $years . ' ' . $code);
            });

        }
    }
}