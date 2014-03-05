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

Route::controller('user', 'UserController');

Route::group(array('before' => 'auth'), function(){    
	Route::controller('home', 'HomeController');
});