<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/11/18
 * Time: 1:06 PM
 */

namespace App\Http\Transformers;


use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id'            => $product->id,
            'price'         => $product->price,
            'quantity'      => $product->quantity,
            'spare_part_id' => $product->spare_part_id
        ];
    }
}