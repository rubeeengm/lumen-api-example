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
    return $router->app->version();
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