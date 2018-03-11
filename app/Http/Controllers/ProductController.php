<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/11/18
 * Time: 1:01 PM
 */

namespace App\Http\Controllers;


use App\Http\Transformers\ProductTransformer;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::where('user_id', $this->getUser()->id)->get();
        $resource = new Collection($products, new ProductTransformer(), 'products');
        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function create(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        $content['user_id'] = $this->getUser()->id;

        $product = Product::create($content);

        $resource = new Item($product, new ProductTransformer(), 'products');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}