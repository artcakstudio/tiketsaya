<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
	Route::get('/', 'AuthController@index');
	Route::post('login','AuthController@login');
	Route::get('logout','AuthController@logout');
});