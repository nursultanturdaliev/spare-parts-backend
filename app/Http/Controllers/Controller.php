<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;
use Tymon\JWTAuth\JWTAuth;

class Controller extends BaseController
{
    protected function getManager()
    {
        $manager = new Manager();
        $manager->setSerializer(new JsonApiSerializer(env('APP_HOST')));
        return $manager;
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        /** @var JWTAuth $JWTAuth */
        $JWTAuth = app('tymon.jwt.auth');
        return $JWTAuth->user();
    }
}
