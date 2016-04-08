<?php

$apiBase = 'api/';
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



// Player Endpoints -- RATE LIMITED
Route::get($apiBase . 'player/{region}/{id}', 'PlayerController@byName');
Route::get($apiBase . 'player/{region}/{id}/{matchid}', 'PlayerController@byIdMatch');


// Match Endpoints -- RATE LIMITED
Route::get($apiBase . 'match/{matchid}', 'MatchController@byId');


// Static Endpoints -- NOT RATE LIMITED
Route::get('api/free', 'StaticController@freeChamps');
Route::get('api/champion/{id}', 'StaticController@championById');