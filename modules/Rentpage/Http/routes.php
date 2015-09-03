<?php

Route::group(['prefix' => 'rentpage', 'namespace' => 'Modules\Rentpage\Http\Controllers'], function()
{
	Route::get('/', 'RentpageController@index');
	Route::post('searchRent',['as'=>'rent.search','uses'=>'RentpageController@scheduleSearch']);
	/*Route::get('transaksi',['as'=>'rentpage.transaksi','uses'=>'RentpageController@transaksipage']);*/
	Route::post('transaksi',['as'=>'rentpage.transaksi.step1','uses'=>'RentpageController@transaksipage']);
	Route::post('preview',['as'=>'rentpage.transaksi.preview','uses'=>'RentpageController@preview']);
});