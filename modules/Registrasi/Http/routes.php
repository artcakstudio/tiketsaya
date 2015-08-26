<?php

Route::group(['prefix' => 'registrasi', 'namespace' => 'Modules\Registrasi\Http\Controllers'], function()
{
	Route::get('/', 'RegistrasiController@index');
	Route::post('edit',['as'=>'register.edit','uses'=>'RegistrasiController@store']);
	Route::get('login','RegistrasiController@login');
	Route::post('login',['as'=>'register.login','uses'=>'RegistrasiController@checkLogin']);
});