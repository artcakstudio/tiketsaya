<?php

Route::group(['prefix' => 'rentpage', 'namespace' => 'Modules\Rentpage\Http\Controllers'], function()
{
	Route::get('/', 'RentpageController@index');
	Route::post('searchRent',['as'=>'rent.search','uses'=>'RentpageController@scheduleSearch']);
	Route::get('transaksi','RentpageController@transaksi');
});