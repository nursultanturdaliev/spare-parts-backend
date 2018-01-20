<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 5:34 AM
 */

namespace App\Transformers;

use App\Manufacturer;
use League\Fractal\TransformerAbstract;

class ManufacturerTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['models'];

    public function transform(Manufacturer $manufacturer)
    {
        return [
            'id' => $manufacturer->id,
            'name' => $manufacturer->name
        ];
    }

    public function includeModels(Manufacturer $manufacturer)
    {
        return $this->collection($manufacturer->models, new ManufacturerModelTransformer(),'models');
    }
}