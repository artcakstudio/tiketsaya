<?php

Route::group(['prefix' => 'registrasi', 'namespace' => 'Modules\Registrasi\Http\Controllers'], function()
{
	Route::get('/', 'RegistrasiController@index');
	Route::post('partner',['as'=>'register.partner','uses'=>'RegistrasiController@store']);
	Route::post('checkusername','RegistrasiController@checkusername');
	Route::get('login','RegistrasiController@login');
	Route::post('login',['as'=>'register.login','uses'=>'RegistrasiController@checkLogin']);
	Route::group(['after'=>'member'],function(){
		Route::get('member','MemberController@index');
		Route::post('member',['as'=>'registrasi.member','uses'=>'MemberController@store']);
	});
});