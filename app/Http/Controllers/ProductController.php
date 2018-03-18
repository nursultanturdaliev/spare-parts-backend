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
use PHPUnit\Util\Json;

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

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product instanceof Product) {
            return new JsonResponse([], 404);
        }

        $resource = new Item($product, new ProductTransformer(), 'products');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function patch($id, Request $request)
    {
        /** @var Product $product */
        $product = Product::find($id);

        $content = json_decode($request->getContent(), true);


        if (!$product instanceof Product) {
            return new JsonResponse([], 404);
        }

        if ($this->getUser()->id !== $product->user_id) {
            return new JsonResponse([], 404);
        }

        $productData = $content['data']['attributes'];

        $product->update([
            'price'         => $productData['price'],
            'quantity'      => $productData['quantity'],
            'spare_part_id' => $productData['spare_part_id']
        ]);

        $resource = new Item($product, new ProductTransformer(), 'products');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}