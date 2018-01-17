<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 7:06 AM
 */

namespace App\Http\Controllers;


use App\ManufacturerModel;
use App\Transformers\ManufacturerModelTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;

class ModelController extends Controller
{
    public function show($id)
    {
        $model = ManufacturerModel::find($id);

        $resource = new Item($model,new ManufacturerModelTransformer(),'model');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}