<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 2/10/18
 * Time: 10:23 PM
 */

namespace App\Http\Controllers;

use App\SparePartCategory;

class SparePartCategoryController extends Controller
{
    public function thumbnail($id)
    {
        $modelGroupYear = SparePartCategory::find($id);

        $response = new \Illuminate\Http\Response($modelGroupYear->thumbnail, 200, array(
            'Content-Type'        => 'image/png',
            'Content-Length'      => strlen($modelGroupYear->thumbnail),
            'Content-Disposition' => 'inline',
        ));

        return $response;
    }
}