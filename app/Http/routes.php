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

Route::get('/player/{region}/{summonerName}', 'PlayerController@showPlayer');

// All Endpoints here are prefixed by api/
Route::group(['prefix' => 'api/'], function () {

    // Player Endpoints -- RATE LIMITED
	Route::get('player/{region}/{name}', 'PlayerController@byName');
	// Player Endpoints -- RATE LIMITED
	Route::get('player/{region}/{name}/job', 'PlayerController@byNameJob');
	Route::get('player/{region}/{name}/force', 'PlayerController@force');
	Route::get('player/{region}/{name}/{matchid}', 'PlayerController@byIdMatch');

	Route::get('summoner/{id}', 'PlayerController@summonerInfo');

	// Get list of challenger players
	Route::get('challenger', 'PlayerController@challenger');

	// Get list of runes by player ID
	Route::get('runes/{id}', 'PlayerController@runesById');

	// Match Endpoints -- RATE LIMITED
	Route::get('match/{matchid}', 'MatchController@byId');
	Route::get('match/{region}/{name}', 'PlayerController@matchHistory');

	// Lookup champion ID, all static updates so -- NOT RATE LIMITED.
	// that said this code is going to need to be made less ugly, 
	Route::get('champion/{championId}', 'ChampionController@lookup');

	// Static Endpoints -- NOT RATE LIMITED
	Route::get('free', 'StaticController@freeChamps');
	Route::get('champion/{id}', 'StaticController@championById');
	Route::get('championList', 'StaticController@championList');

	//Temporary endpoint, eventually this should exclusively be a job.
	Route::get('updateChampionList', 'ChampionController@updateList');


});

Route::get('*', 'HomeController@index');
