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
        'as' => 'manufacturer_models', 'uses' => 'ManufacturerController@show'
    ]);

    $router->get('manufacturers/{id}/models', [
        'as' => 'manufacturer_models', 'uses' => 'ManufacturerController@models'
    ]);

    $router->get('manufacturers/{id}/thumbnail', [
        'as' => 'manufacturer_thumbnail', 'uses' => 'ManufacturerController@thumbnail'
    ]);

    $router->get('models/{id}', [
            'as' => 'model', 'uses' => 'ModelController@show']
    );

    $router->get('catalogTypes', [
        'as' => 'catalogTypes', 'uses' => 'CatalogTypeController@index'
    ]);

    $router->get('modelGroupYears/{id}', [
        'as' => 'model_group_year', 'uses' => 'ModelGroupYearController@show'
    ]);

    $router->get('sparePartCategory/{id}/thumbnail', [
        'as' => 'model_group_year_thumbnail', 'uses' => 'SparePartCategoryController@thumbnail'
    ]);

    $router->get('catalogTypes/{slug}', [
        'as' => 'catalogTypes', 'uses'=> 'CatalogTypeController@show'
    ]);
});
