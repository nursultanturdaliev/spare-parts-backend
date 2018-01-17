<?php


/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('manufacturer', [
        'as' => 'manufacturers', 'uses' => 'ManufacturerController@all'
    ]);

    $router->get('manufacturer/{id}/model', [
        'manufacturer_models', 'uses' => 'ManufacturerController@models'
    ]);

    $router->get('model/{id}', ['model', 'uses' => 'ModelController@show']);
});
