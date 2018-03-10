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
    protected $availableIncludes = ['sparePartGroups'];

    public function transform(SparePartCategory $sparePartCategory)
    {
        return [
            'id'   => $sparePartCategory->id,
            'name' => $sparePartCategory->name
        ];
    }

    public function includeSparePartGroups(SparePartCategory $sparePartCategory)
    {
        return $this->collection($sparePartCategory->sparePartGroups, new SparePartGroupTransformer(), "sparePartGroups");
    }
}