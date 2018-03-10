<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 1:30 PM
 */

namespace App\Transformers;


use App\ModelGroupYear;
use League\Fractal\TransformerAbstract;

class ModelGroupYearTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['sparePartCategories'];

    public function transform(ModelGroupYear $modelGroupYear)
    {
        return [
            'id'   => $modelGroupYear->id,
            'name' => $modelGroupYear->name
        ];
    }

    public function includeSparePartCategories(ModelGroupYear $modelGroupYear)
    {
        return $this->collection($modelGroupYear->sparePartCategories, new SparePartCategoryTransformer(), 'sparePartCategories');
    }
}