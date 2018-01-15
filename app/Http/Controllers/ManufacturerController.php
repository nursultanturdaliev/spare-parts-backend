<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/15/18
 * Time: 10:15 PM
 */

namespace App\Http\Controllers;


use App\Manufacturer;
use Illuminate\Http\JsonResponse;

class ManufacturerController extends Controller
{
    public function all()
    {
        return new JsonResponse(Manufacturer::all());
    }
}