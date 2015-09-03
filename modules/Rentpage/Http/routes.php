<?php

Route::group(['prefix' => 'rentpage', 'namespace' => 'Modules\Rentpage\Http\Controllers'], function()
{
	Route::get('/', 'RentpageController@index');
	Route::post('searchRent',['as'=>'rent.search','uses'=>'RentpageController@scheduleSearch']);
	Route::get('transaksi/{id}','RentpageController@transaksipage');
	Route::post('transaksi',['as'=>'rentpage.transaksi','uses'=>'RentpageController@transaksiSubmit']);
	Route::post('preview',['as'=>'rentpage.transaksi.preview','uses'=>'RentpageController@preview']);
});