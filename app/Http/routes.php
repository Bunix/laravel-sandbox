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
 * Development Routes
 */
Route::get('test', function()
{
	dd(App::environment());
});

Route::get('info', function()
{
	phpinfo();
});

/*
 * Frontend Routes
 */

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::controller('mailer', 'MailerController');
Route::controller('billing', 'BillingController');


/*
 *  Admin Routes
 */

Route::group(array('prefix' => 'admin'), function()
{
	Route::any('login', array('as' => 'adminlogin', 'uses' => 'Admin\AuthAdminController@adminLogin'))->before('guest');

	Route::group(array('before' => 'auth'), function()
	{
		Route::any('/', array('as' => 'adminhome', 'uses' => 'Admin\UserAdminController@index'));

		// Logout Route
		Route::any('logout', array('as' => 'adminlogout', 'uses' => 'Admin\AuthAdminController@adminLogout'));

	});
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
