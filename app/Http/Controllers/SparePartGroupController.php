<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 3/3/18
 * Time: 11:51 PM
 */

namespace App\Http\Controllers;


use App\SparePartGroup;

class SparePartGroupController
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
}