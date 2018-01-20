<?php


/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('manufacturers', [
        'as' => 'manufacturers', 'uses' => 'ManufacturerController@all'
    ]);

    $router->get('manufacturers/{id}', [
        'manufacturer_models', 'uses' => 'ManufacturerController@show'
    ]);

    $router->get('models/{id}', ['model', 'uses' => 'ModelController@show']);
});
