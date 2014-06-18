<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Test Routes
Route::get('test', function()
{
    dd(App::environment());
});

//  Frontend Routes
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::controller('mailer', 'MailerController');
Route::controller('billing', 'BillingController');


// Admin Routes
Route::group(array('prefix' => 'admin'), function()
{
    Route::any('login', array('as' => 'adminlogin', 'uses' => 'AuthAdminController@adminLogin'))->before('guest');

    Route::group(array('before' => 'auth'), function()
    {
        Route::any('/', array('as' => 'adminhome', 'uses' => 'UserAdminController@index'));

        // Logout Route
        Route::any('logout', array('as' => 'adminlogout', 'uses' => 'AuthAdminController@adminLogout'));

    });
});

// API Routes
Route::group(array('prefix' => 'api/v1'), function() {
    Route::resource('users', 'UserAPIController');
});


