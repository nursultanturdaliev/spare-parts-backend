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
use League\Fractal\Resource\Item;

class ManufacturerController extends Controller
{
    public function all()
    {
        $manufacturers = Manufacturer::all();
        $resource = new Collection($manufacturers, new ManufacturerTransformer(), 'manufacturers');


        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }

    public function show($id)
    {

        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer instanceof Manufacturer) {
            return new JsonResponse([], 404);
        }

        $resource = new Item($manufacturer, new ManufacturerTransformer(), 'manufacturers');
        $manager = $this->getManager();
        $manager->parseIncludes('models');

        return new JsonResponse($manager->createData($resource)->toArray());
    }

    public function thumbnail($id)
    {
        $manufacturer = Manufacturer::find($id);

        $response = new \Illuminate\Http\Response($manufacturer->thumbnail, 200, array(
            'Content-Type'        => 'image/png',
            'Content-Length'      => strlen($manufacturer->thumbnail),
            'Content-Disposition' => 'inline',
        ));

        return $response;
    }

    public function models($id)
    {
        $models = ManufacturerModel::where(['manufacturer_id' => $id])->get();
        $resource = new Collection($models, new ManufacturerModelTransformer(), 'models');

        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}