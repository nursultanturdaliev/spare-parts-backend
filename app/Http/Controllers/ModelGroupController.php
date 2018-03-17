<?php

namespace App\Http\Controllers;


use App\ModelGroup;
use App\Transformers\ModelGroupTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;

class ModelGroupController extends Controller
{
    public function show($id)
    {
        /** @var ModelGroup $modelGroup */
        $modelGroup = ModelGroup::find($id);

        $resource = new Item($modelGroup, new ModelGroupTransformer(), 'modelGroups');
        $manager = $this->getManager();
        return new JsonResponse($manager->createData($resource)->toArray());
    }
}