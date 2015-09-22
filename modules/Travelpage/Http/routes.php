<?php

Route::group(['prefix' => 'travelpage', 'namespace' => 'Modules\Travelpage\Http\Controllers'], function()
{
	Route::get('/', 'TravelpageController@index');
	Route::post('searchTravel',['as'=>'travelpage.search','uses'=>'TravelpageController@scheduleSearch']);
	Route::post('travelSearch',['as'=>'travelpage.search.footer','uses'=>'TravelpageController@scheduleSearchRentang']);
	Route::post('transaksi/step1',['as'=>'travelpage.transaksi.step1', 'uses'=> 'TravelpageController@transaksi_step1']);
	Route::post('transaksi',['as'=>'travelpage.transaksi','uses'=>'TravelpageController@transaksiSubmit']);
	Route::post('preview',['as'=>'travelpage.transaksi.preview','uses'=>'TravelpageController@preview']);
});