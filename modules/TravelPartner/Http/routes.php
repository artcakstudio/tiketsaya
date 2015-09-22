<?php

Route::group(['prefix' => 'travelpartner', 'namespace' => 'Modules\TravelPartner\Http\Controllers', 'middleware'=>'partnercheck'], function()
{
	Route::get('/', 'TravelPartnerController@index');
	Route::post('update',['as'=>'travelpartner.update','uses'=>'TravelPartnerController@update']);
	Route::post('updatepassword',['as'=>'travelpartner.update.password','uses'=>'TravelPartnerController@updatepassword']);
	Route::get('logout','TravelPartnerController@logout');
	Route::post('detail_jadwal','JadwalController@detail_jadwal');
	Route::get('transaksi','TransaksiController@transaksi');
	Route::get('transaksi/getTransaksi','TransaksiController@getTransaksi');

	Route::group(['after'=>'route'],function(){
		Route::get('route','RouteController@index');
		Route::get('route/getroutepartner','RouteController@getRoutePartner');
	});
	Route::group(['after'=>'armada'],function(){
		Route::get('armada','RouteController@armada');
		Route::get('armada/getarmada','RouteController@getarmada');
	});
	Route::group(['after'=>'jadwal'],function(){
		Route::get('jadwal/{id}','JadwalController@jadwal');
		Route::get('jadwal/mingguan','JadwalController@mingguan');
		Route::get('jadwal/umum','JadwalController@jadwalUmum');
		Route::get('jadwal/umum_mingguan','JadwalController@umum_mingguan');
		Route::get('jadwal/jadwalharian/{tanggal}','JadwalController@jadwalharian');
		Route::get('jadwal/harian/{id}','JadwalController@jadwal_harian');
		Route::post('jadwal/mingguan_detail','JadwalController@mingguan_detail');
		Route::post('jadwal/add',['as'=>'travelpartner.jadwal.add','uses'=>'JadwalController@addJadwal']);
		Route::post('jadwal/mingguan/','JadwalController@addJadwalMingguan');
	});
});