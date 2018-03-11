<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/4/18
 * Time: 12:08 AM
 */

namespace App\Transformers;


use App\Http\Transformers\ProductTransformer;
use App\SparePart;
use League\Fractal\TransformerAbstract;

class SearchSparePartTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['products'];

    public function transform(SparePart $sparePart)
    {
        return [
            'id'          => $sparePart->id,
            'number'      => $sparePart->number,
            'name'        => $sparePart->name,
            'description' => $sparePart->description
        ];
    }

    public function includeProducts(SparePart $sparePart)
    {
        return $this->collection($sparePart->products, new ProductTransformer(), 'products');
    }
}