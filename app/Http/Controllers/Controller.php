<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class Controller extends BaseController
{
    protected function getManager()
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer(env('APP_HOST')));
        return $manager;
    }
}
