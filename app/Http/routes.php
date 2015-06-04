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

// This was  test to see if I could create a fake route for a webpage
//Route::get('/{name?}', 'MyController@index');

Route::group(array('prefix' => 'api/v1'),function()
{
	Route::resource('appointments','AppointmentsController',['except'=>['create','edit']]);
});

