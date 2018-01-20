<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 7:06 AM
 */

namespace App\Http\Controllers;


use App\ManufacturerModel;
use App\ModelDesignation;
use App\Transformers\DesignationTransformer;
use App\Transformers\ManufacturerModelTransformer;
use App\Transformers\ModelItemTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ModelController extends Controller
{
    public function show($id)
    {
        $model = ManufacturerModel::find($id);

        $resource = new Item($model, new ModelItemTransformer(), 'models');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function designations($id)
    {
        $designations = ModelDesignation::where(['model_id' => $id])->get();

        $resource = new Collection($designations, new DesignationTransformer(), 'designations');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}