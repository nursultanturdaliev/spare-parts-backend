<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/3/18
 * Time: 11:40 PM
 */

namespace App\Transformers;


use App\SparePartGroup;
use League\Fractal\TransformerAbstract;

class SparePartGroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['spareParts'];

    public function transform(SparePartGroup $sparePartGroup)
    {
        return [
            'id' => $sparePartGroup->id,
            'name' => $sparePartGroup->name,
            'image_html'=>$sparePartGroup->image_html
        ];
    }

    public function includeSpareParts(SparePartGroup $sparePartGroup)
    {
        return $this->collection($sparePartGroup->spareParts, new SparePartTransformer(), 'spareParts');
    }
}