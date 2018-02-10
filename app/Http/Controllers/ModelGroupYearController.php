<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 9:58 PM
 */

namespace App\Http\Controllers;


use App\ModelGroupYear;
use App\Transformers\ModelGroupYearTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Resource\Item;

class ModelGroupYearController extends Controller
{
    public function show($id)
    {
        /** @var ModelGroupYear $modelGroupYear */
        $modelGroupYear = ModelGroupYear::find($id);

        $resource = new Item($modelGroupYear, new ModelGroupYearTransformer(), 'modelGroupYears');
        $manager = $this->getManager();
        $manager->parseIncludes('sparePartCategoryTypes');

        return new JsonResponse($manager->createData($resource)->toArray());
    }
}