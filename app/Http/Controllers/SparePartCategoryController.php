<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 10:23 PM
 */

namespace App\Http\Controllers;

use App\SparePartCategory;
use App\Transformers\SparePartCategoryTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;

class SparePartCategoryController extends Controller
{
    public function thumbnail($id)
    {
        $sparePartCategory = SparePartCategory::find($id);

        $response = new \Illuminate\Http\Response($sparePartCategory->thumbnail, 200, array(
            'Content-Type' => 'image/png',
            'Content-Length' => strlen($sparePartCategory->thumbnail),
            'Content-Disposition' => 'inline',
        ));

        return $response;
    }

    public function show($id)
    {
        $sparePartCategory = SparePartCategory::find($id);

        if (!$sparePartCategory instanceof SparePartCategory) {
            return new JsonResponse([], 404);
        }

        $resource = new Item($sparePartCategory, new SparePartCategoryTransformer(), 'sparePartCategories');

        $manager = $this->getManager();
        $manager->parseIncludes('sparePartGroups');

        return new JsonResponse($manager->createData($resource)->toArray());
    }
}