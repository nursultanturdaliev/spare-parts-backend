<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/26/18
 * Time: 9:29 PM
 */

namespace App\Http\Controllers;


use App\CatalogType;
use App\Transformers\CatalogTypeTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class CatalogTypeController extends Controller
{
    public function index()
    {
        $catalogTypes = CatalogType::all();

        $resource = new Collection($catalogTypes, new CatalogTypeTransformer(), 'catalogTypes');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function show($slug)
    {
        $catalogType = CatalogType::where('slug',$slug)->firstOrFail();

        $resource = new Item($catalogType, new CatalogTypeTransformer(),'catalogTypes');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}