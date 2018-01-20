<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/20/18
 * Time: 11:45 AM
 */

namespace App\Console\Commands;


use App\ModelDesignation;
use App\Modification;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateDesignations extends Command
{
    protected $name = 'app:designation';

    public function run(InputInterface $input, OutputInterface $output)
    {
        ModelDesignation::chunk(200, function ($modelDesignations) use ($output) {
            /** @var ModelDesignation $modelDesignation */
            foreach ($modelDesignations as $modelDesignation) {
                /** @var Modification $modification */
                $columns = [
                    1 => 'modification',
                    2 => 'code',
                    3 => 'engine_type',
                    4 => 'engine_model',
                    5 => 'engine_volume',
                    6 => 'engine_power',
                    7 => 'wheel_drive',
                    8 => 'transmission',
                    9 => 'number_of_doors',
                    10 => 'release_date',
                    11 => 'lifting_capacity',
                    12 => 'chassis_configuration'
                ];
                /** @var Modification $modification */
                foreach ($modelDesignation->modifications as $modification) {
                    $column = $columns[$modification->modification_type_id];
                    $modelDesignation->{$column} = $modification->name;
                }

                $modelDesignation->save();
                $output->writeln('Updated Designation - ' . $modelDesignation->id);
            }
        });
    }

}