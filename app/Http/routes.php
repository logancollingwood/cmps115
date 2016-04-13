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
Route::get('/', 'HomeController@index');


// Declare a method in app/Http/Controllers/HomeController.php and
// the url home/function_name should route to the function in HomeController
Route::resource('home', 'HomeController');


// All Endpoints here are prefixed by api/
Route::group(['prefix' => 'api/'], function () {

    // Player Endpoints -- RATE LIMITED
	Route::get('player/{region}/{name}', 'PlayerController@byName');
	Route::get('player/{region}/{name}/{matchid}', 'PlayerController@byIdMatch');


	// Match Endpoints -- RATE LIMITED
	Route::get('match/{matchid}', 'MatchController@byId');
	Route::get('match/{region}/{name}', 'PlayerController@matchHistory');

	// Static Endpoints -- NOT RATE LIMITED
	Route::get('free', 'StaticController@freeChamps');
	Route::get('champion/{id}', 'StaticController@championById');


});