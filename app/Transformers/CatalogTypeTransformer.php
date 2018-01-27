<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/27/18
 * Time: 1:33 PM
 */

namespace App\Transformers;


use App\CatalogType;
use App\Manufacturer;
use League\Fractal\TransformerAbstract;

class CatalogTypeTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['manufacturers'];

    public function transform(CatalogType $catalogType)
    {
        return [
            'id'   => $catalogType->id,
            'name' => $catalogType->name
        ];
    }

    public function includeManufacturers(CatalogType $catalogType)
    {
        return $this->collection($catalogType->manufacturers, new ManufacturerTransformer(), 'manufacturers');
    }
}