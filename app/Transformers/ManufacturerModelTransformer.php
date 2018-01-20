<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 6:26 AM
 */

namespace App\Transformers;


use App\ManufacturerModel;
use League\Fractal\TransformerAbstract;

class ManufacturerModelTransformer extends TransformerAbstract
{

    public function transform(ManufacturerModel $model)
    {
        return [
            'id'                 => $model->id,
            'name'               => $model->name,
            'manufactured_years' => $model->manufactured_years
        ];
    }
}