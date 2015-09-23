<?php

Route::group(['prefix' => 'pesawat', 'namespace' => 'Modules\Pesawat\Http\Controllers'], function()
{
	Route::get('/', 'PesawatController@index');
	Route::post('hasil-search','PesawatController@search');
	Route::post('transaksi/step1',['as'=>'pesawat.transaksi.step1', 'uses'=>'PesawatController@step1']);
});
