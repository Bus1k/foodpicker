<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/restaurant'], function () use ($router) {

    $router->post('add', 'RestaurantController@store');

    $router->get('get/{id}', 'RestaurantController@get');
    $router->get('all', 'RestaurantController@all');
    $router->get('random', 'RestaurantController@random');

    $router->put('update/{id}', 'RestaurantController@update');

    $router->delete('delete/{id}', 'RestaurantController@delete');
});
