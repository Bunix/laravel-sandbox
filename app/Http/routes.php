<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

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

        Route::get('/', function () {
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

});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes for api endpoints
|
*/

Route::group(['middleware' => ['api'], 'namespace' => 'API\V1', 'prefix' => 'api'], function () {

    Route::get('/user/search', array('uses' => 'UserController@search'));

    Route::resources([
        'user' => 'UserController'
    ]);

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




