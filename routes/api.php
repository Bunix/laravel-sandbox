<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', ['middleware' => [/*'auth:api', /'api.throttle'*/], /*'limit' => 5, 'expires' => 1*/], function ($api) {

    // Users Routes
    $api->get('users', 'App\Http\Controllers\API\V1\UserController@index');
    $api->get('users/paginate', 'App\Http\Controllers\API\V1\UserController@paginate');
    $api->get('users/{id}', 'App\Http\Controllers\API\V1\UserController@show');
    $api->post('users', 'App\Http\Controllers\API\V1\UserController@store');
    $api->put('users/{id}', 'App\Http\Controllers\API\V1\UserController@update');
    $api->delete('users/{id}', 'App\Http\Controllers\API\V1\UserController@destroy');

});