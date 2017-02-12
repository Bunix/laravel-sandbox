<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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
    Route::get('register', 'RegisterController@showRegistrationForm');
    Route::post('register', 'RegisterController@register');
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('password/email', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'ResetPasswordController@showResetForm');
    Route::post('password/reset', 'ResetPasswordController@reset');
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
        Route::get('api-test', 'APITestController@index');
        Route::get('billing', 'BillingController@index');
        Route::get('mailer', 'MailerController@index');
        Route::get('test', 'TestController@index');
        Route::get('test/alert', 'TestController@alert');
        Route::get('test/logger', 'TestController@logger');
        Route::get('test/text', 'TestController@text');
        Route::get('test/highway', 'TestController@highway');
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