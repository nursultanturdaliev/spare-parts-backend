<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 10:04 PM
 */

namespace App\Transformers;


use App\SparePartCategory;
use League\Fractal\TransformerAbstract;

class SparePartCategoryTransformer extends TransformerAbstract
{
    public function transform(SparePartCategory $sparePartCategory)
    {
        return [
            'id'   => $sparePartCategory->id,
            'name' => $sparePartCategory->name
        ];
    }
}