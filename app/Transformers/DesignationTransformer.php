<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/20/18
 * Time: 8:02 AM
 */

namespace App\Transformers;


use App\ModelDesignation;
use League\Fractal\TransformerAbstract;

class DesignationTransformer extends TransformerAbstract
{
    public function transform(ModelDesignation $designation)
    {
        return [
            'id'                    => $designation->id,
            'modification'          => $designation->modification,
            'code'                  => $designation->code,
            'engine_type'           => $designation->engine_type,
            'engine_model'          => $designation->engine_model,
            'engine_volume'         => $designation->engine_volume,
            'engine_power'          => $designation->engine_power,
            'wheel_drive'           => $designation->wheel_drive,
            'transmission'          => $designation->transmission,
            'number_of_doors'       => $designation->number_of_doors,
            'release_date'          => $designation->release_date,
            'lifting_capacity'      => $designation->lifting_capacity,
            'chassis_configuration' => $designation->chassis_configuration
        ];
    }
}