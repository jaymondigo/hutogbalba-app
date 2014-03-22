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
Route::get('/', function(){

	if(Auth::user())
		return Redirect::to('/home');
	else
		return Redirect::to('/user/login');
});
 
// Confide routes
Route::get('/', function () {
	return View::make('public.home');
});
Route::get( 'user/register',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');


Route::group(array('before' => 'auth'), function(){    
	Route::controller('home', 'HomeController');
	Route::controller('dreamer','DreamerController');
	Route::controller('admin','AdminController');
	
	Route::resource('product', 'ProductController'); 
	Route::controller('product', 'ProductController'); 
	Route::controller('user', 'UserController'); 
	Route::resource('vendor','VendorController');
	Route::controller('vendor', 'VendorController'); 
});
