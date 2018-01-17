<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/15/18
 * Time: 10:15 PM
 */

namespace App\Http\Controllers;


use App\Manufacturer;
use App\ManufacturerModel;
use App\Transformers\ManufacturerModelTransformer;
use App\Transformers\ManufacturerTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Collection;

class ManufacturerController extends Controller
{
    public function all()
    {
        $manufacturers = Manufacturer::all();
        $resource = new Collection($manufacturers, new ManufacturerTransformer(), 'manufacturer');


        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function models($id)
    {
        $models = ManufacturerModel::where('manufacturer_id', $id)->get();

        $resource = new Collection($models, new ManufacturerModelTransformer(), 'model');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}