<?php

Route::group(['prefix' => 'travelpage', 'namespace' => 'Modules\Travelpage\Http\Controllers'], function()
{
	Route::get('/', 'TravelpageController@index');
	Route::post('searchTravel',['as'=>'travelpage.search','uses'=>'TravelpageController@scheduleSearch']);
	Route::get('transaksi/{id}','TravelpageController@transaksi');
	Route::post('transaksi',['as'=>'travelpage.transaksi','uses'=>'TravelpageController@transaksiSubmit']);
});