<?php

Route::group(['prefix' => 'pesawat', 'namespace' => 'Modules\Pesawat\Http\Controllers'], function()
{
	Route::get('/', 'PesawatController@index');
	Route::post('hasil-search','PesawatController@search');
	Route::group(['after'=>'transaksi'],function(){
		Route::post('transaksi/step1',['as'=>'pesawat.transaksi.step1', 'uses'=>'PesawatController@step1']);
		Route::post('transaksi/preview',['as'=>'pesawat.transaksi.preview', 'uses'=>'PesawatController@preview']);
	});
	Route::post('search-ajax','PesawatController@hasil_search');
	Route::post('filter_harga','PesawatController@filter_harga');
});
