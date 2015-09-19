<?php

Route::group(['prefix' => 'pesawat', 'namespace' => 'Modules\Pesawat\Http\Controllers'], function()
{
	Route::get('/', 'PesawatController@index');
	Route::get('hasil-search','PesawatController@search');
});