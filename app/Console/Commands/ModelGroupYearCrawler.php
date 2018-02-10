<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 11:52 AM
 */

namespace App\Console\Commands;


use App\ModelGroup;
use App\ModelGroupYear;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ModelGroupYearCrawler extends BaseAcatCommand
{
    protected $name = 'acat:crawler:year';

    public function run(InputInterface $input, OutputInterface $output)
    {
        $modelGroups = ModelGroup::all();

        /** @var ModelGroup $modelGroup */
        foreach ($modelGroups as $modelGroup) {
            $content = $modelGroup->years_content;

            $crawler = new Crawler($content);

            $crawler->filter('div.modal-year>a')->each(function (Crawler $crawler) use ($output, $modelGroup) {
                $href = $crawler->attr('href');
                $text = $crawler->text();

                $client = new Client();
                $response = $client->get($this->domain . $href);

                ModelGroupYear::create([
                    'href'           => $href,
                    'name'           => $text,
                    'content'        => $response->getBody()->getContents(),
                    'model_group_id' => $modelGroup->id
                ]);

                $output->writeln($text);
            });
        }
    }

}