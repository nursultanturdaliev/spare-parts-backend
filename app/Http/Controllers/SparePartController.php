<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/11/18
 * Time: 1:39 AM
 */

namespace App\Http\Controllers;


use App\SparePart;
use App\Transformers\SearchSparePartTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;

class SparePartController extends Controller
{
    public function search(Request $request)
    {
        $searchText = $request->get('search');

        if (!$searchText) {
            return new JsonResponse([], 404);
        }

        $spareParts = SparePart::where('name', 'LIKE', '%' . $searchText . '%')->orWhere('description', 'LIKE', '%' . $searchText . '%')->limit(100)->get();

        $resource = new Collection($spareParts, new SearchSparePartTransformer(), 'spareParts');
        return new JsonResponse($this->getManager()->createData($resource)->toArray());
    }
}