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
    public function transform(Manufacturer $manufacturer)
    {
        return [
            'id' => $manufacturer->id,
            'name' => $manufacturer->name
        ];
    }
}