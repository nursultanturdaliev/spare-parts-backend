<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/3/18
 * Time: 11:51 PM
 */

namespace App\Http\Controllers;


use App\SparePartGroup;
use App\Transformers\SparePartGroupTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;

class SparePartGroupController extends Controller
{
    public function thumbnail($id)
    {
        $sparePartGroup = SparePartGroup::find($id);

        $response = new \Illuminate\Http\Response($sparePartGroup->thumbnail, 200, array(
            'Content-Type' => 'image/png',
            'Content-Length' => strlen($sparePartGroup->thumbnail),
            'Content-Disposition' => 'inline',
        ));

        return $response;
    }

    public function show($id)
    {
        $sparePartGroup = SparePartGroup::find($id);

        if (!$sparePartGroup instanceof SparePartGroup) {
            return new JsonResponse([], 404);
        }

        $resource = new Item($sparePartGroup, new SparePartGroupTransformer(), 'sparePartGroups');
        $manager = $this->getManager();
        $manager->parseIncludes('spareParts');
        return new JsonResponse($manager->createData($resource)->toArray());
    }
}