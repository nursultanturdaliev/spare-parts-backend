<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 10:46 PM
 */

namespace App\Console\Commands;

use App\ManufacturerModel;
use App\ModelDesignation;
use App\Modification;
use App\ModificationType;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ModelCrawlerCommand extends BaseCrawlerCommand
{
    protected $name = 'app:crawler-model';

    public function run(InputInterface $input, OutputInterface $output)
    {
        ManufacturerModel::chunk(100, function ($manufacturerModels) use ($output) {
            /** @var ManufacturerModel $manufacturerModel */
            foreach ($manufacturerModels as $manufacturerModel) {
                if ($manufacturerModel->id < 8418) {
                    continue;
                }
                $this->crawlModel($output, $manufacturerModel);
            }
        });

    }

    /**
     * @param OutputInterface $output
     * @param $manufacturerModel
     */
    public function crawlModel(OutputInterface $output, ManufacturerModel $manufacturerModel): void
    {
        $guzzle = new Client();
        $response = $guzzle->get($this->hostname . $manufacturerModel->href);
        $contents = $response->getBody()->getContents();

        $crawler = new Crawler($contents);

        $trHeaders = $crawler->filter('#gvData tr:first-child th');
        $trs = $crawler->filter('#gvData tr:not(:first-child)');

        if ($trHeaders->count() == 0) {
            return;
        }

        $manufacturerModel->content = $contents;
        $manufacturerModel->save();

        $types = [];

        $trHeaders->each(function (Crawler $header, $index) use (&$types) {
            $type = trim($header->text());
            if ($type) {
                $modificationType = ModificationType::firstOrCreate(['name' => $type]);
                $types[$index] = $modificationType;
            }
        });


        $output->writeln($manufacturerModel->href);
        $trs->each(function (Crawler $tr, $ignored) use ($output, $manufacturerModel, $types) {

            $href = $tr->filter('a')->first()->attr('href');

            /** @var ModelDesignation $modelDesignation */
            $modelDesignation = ModelDesignation::create(['model_id' => $manufacturerModel->id, 'href' => $href]);
            $modelDesignation->save();

            $tr->filter('td')->each(function (Crawler $crawler, $index) use ($types, $modelDesignation) {

                $modification = new Modification([
                    'name' => $crawler->text(),
                    'modification_type_id' => $types[$index]->id,
                    'model_designation_id' => $modelDesignation->id
                ]);
                $modification->save();

            });

        });

    }
}