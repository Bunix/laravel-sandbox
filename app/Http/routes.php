<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| Routes for public users of application
|
*/

Route::group(['namespace' => 'Customer'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::controllers([

    ]);
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes for internal admin users of application
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => config('route.prefix.admin'), 'middleware' => 'auth'], function () {

    Route::get('/'.config('route.prefix.admin'), function () {
        return view('admin.home');
    });

    Route::controllers([

    ]);

});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Routes for authentication of application
|
*/

Route::group(['namespace' => 'Auth'], function () {
    Route::controllers([
        'auth' => 'AuthController',
        'password' => 'PasswordController'
    ]);
});


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes for api endpoints of application
|
*/

Route::group(['namespace' => 'API', 'prefix' => 'api'], function () {

    Route::get('/user/search', array('uses' => 'V1\UserAPIController@search'));

    Route::resources([
        'user' => 'V1\UserAPIController'
    ]);

});

/*
|--------------------------------------------------------------------------
| Examples Routes
|--------------------------------------------------------------------------
|
| Routes for examples valid only in test environments
|
*/

Route::group(['namespace' => 'Examples'], function () {

    if (App::environment() != 'production') {
        Route::controllers([
            'api-test' => 'APITestController',
            'billing' => 'BillingController',
            'mailer' => 'MailerController',
            'test' => 'TestController'
        ]);
    }
});

/*
|--------------------------------------------------------------------------
| Development Routes
|--------------------------------------------------------------------------
|
| Routes for developer information
|
*/

Route::get('env', function () {
    dd(App::environment());
});

Route::get('info', function () {
    if (App::environment() != 'production') {
        phpinfo();
    }
});




