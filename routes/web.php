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
        'as' => 'manufacturer_show', 'uses' => 'ManufacturerController@show'
    ]);

    $router->get('manufacturers/{id}/thumbnail', [
        'as' => 'manufacturer_thumbnail', 'uses' => 'ManufacturerController@thumbnail'
    ]);

    $router->get('catalogTypes', [
        'as' => 'catalogTypes', 'uses' => 'CatalogTypeController@index'
    ]);

    $router->get('modelGroups/{id}', [
        'as' => 'model_group', 'uses' => 'ModelGroupController@show'
    ]);

    $router->get('modelGroupYears/{id}', [
        'as' => 'model_group_year', 'uses' => 'ModelGroupYearController@show'
    ]);

    $router->get('sparePartCategory/{id}/thumbnail', [
        'as' => 'spare_part_category_thumbnail', 'uses' => 'SparePartCategoryController@thumbnail'
    ]);

    $router->get('sparePartCategories/{id}', [
        'as' => 'spare_part_category_show', 'uses' => 'SparePartCategoryController@show'
    ]);

    $router->get('sparePartGroups/{id}', [
        'as' => 'spare_part_group_show', 'uses' => 'SparePartGroupController@show'
    ]);

    $router->get('sparePartGroups/{id}/thumbnail', [
        'as' => 'spare_part_group_thumbnail', 'uses' => 'SparePartGroupController@thumbnail'
    ]);

    $router->get('catalogTypes/{slug}', [
        'as' => 'catalogTypes', 'uses' => 'CatalogTypeController@show'
    ]);

    $router->get('spareParts', [
        'as' => 'sparePartSearch', 'uses' => 'SparePartController@all'
    ]);
});

$router->group(['prefix' => 'api', 'middleware' => ['auth']], function () use ($router) {
    $router->get('products', [
        'as' => 'products', 'uses' => 'ProductController@all'
    ]);

    $router->post('products', [
        'as' => 'products_create', 'uses' => 'ProductController@create'
    ]);

    $router->get('products/{id}', [
        'as' => 'products_show', 'uses' => 'ProductController@show'
    ]);
    
    $router->patch('products/{id}', [
        'as' => 'products_show', 'uses' => 'ProductController@patch'
    ]);
});

$router->post('/auth/login', 'AuthController@postLogin');
$router->post('/user/register', 'UserController@register');
