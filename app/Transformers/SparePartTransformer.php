<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/4/18
 * Time: 12:08 AM
 */

namespace App\Transformers;


use App\SparePart;
use League\Fractal\TransformerAbstract;

class SparePartTransformer extends TransformerAbstract
{
    public function transform(SparePart $sparePart)
    {
        return [
            'id'          => $sparePart->id,
            'number'      => $sparePart->number,
            'name'        => $sparePart->name,
            'description' => $sparePart->description
        ];
    }
}