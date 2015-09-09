<?php

Route::group(['prefix' => 'rentpartner', 'namespace' => 'Modules\Rentpartner\Http\Controllers', 'middleware'=>'rentcheck'], function()
{
	Route::get('/', 'RentPartnerController@index');
	Route::post('update',['as'=>'rentpartner.update','uses'=>'RentPartnerController@update']);
	Route::post('updatepassword',['as'=>'rentpartner.update.password','uses'=>'RentPartnerController@updatepassword']);
	Route::get('logout','RentPartnerController@logout');

	Route::group(['after'=>'armada'],function(){
		Route::get('armada','RouteController@armada');
		Route::get('armada/getarmada','RouteController@getarmada');
	});
	Route::group(['after'=>'jadwal'],function(){
		Route::get('jadwal/mingguan','JadwalController@mingguan');
		Route::get('jadwal/{id}','JadwalController@jadwal');
		Route::post('jadwal/add',['as'=>'rentpartner.jadwal.add','uses'=>'JadwalController@addJadwal']);
		Route::get('jadwal/jadwalharian/{tanggal}','JadwalController@jadwalharian');
		Route::get('jadwal/harian/{id}','JadwalController@jadwal_harian');
		Route::post('jadwal/mingguan/','JadwalController@addJadwalMingguan');
		Route::post('jadwal/harian',['as'=>'rentpartner.jadwal.store','uses'=>'JadwalController@addJadwalHarian']);
	});
});