<?php

use Illuminate\Http\Request;

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
    return [
        'version' => $router->app->version()
        , 'environment' =>  $router->app->environment()
    ];
});

$router->get('/example/{id}', function(int $id) {
    return "Se pasó el parámetro " . $id;
});

$router->get('/example', ['middleware' => 'example', function() {
    return [
        'company' => 'Proday'
    ];
}]);

$router->post('/example', function(Request $request) {
    return [
        'name' => $request->input('name')
        , 'lastName' => $request->input('lastName')
    ];
});

$router->get('/example-controller', 'ExampleController@index');

$router->group(['middleware' => 'auth', 'prefix' => 'products'], function() use ($router) {
    $router->get('/', 'ProductController@index');
    $router->get('/{id}', 'ProductController@show');
    $router->post('/', 'ProductController@store');
    $router->put('/{id}', 'ProductController@update');
    $router->post('/{id}/image', 'ProductController@image');
    $router->delete('/{id}', 'ProductController@destroy');
});

$router->group(['middleware' => 'auth', 'prefix' => 'orders'], function() use
($router) {
    $router->get('/', 'OrderController@index');
    $router->get('/{id}', 'OrderController@show');
    $router->get('/{id}/items', 'OrderController@items');
    $router->post('/', [
        'middleware' => 'role:admin'
        , 'uses' => 'OrderController@store'
    ]);
});

$router->post('identity/signin', 'IdentityController@signin');
$router->post('identity/test', 'IdentityController@test');
