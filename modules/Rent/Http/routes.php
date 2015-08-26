<?php

Route::group(['prefix' => 'rent', 'namespace' => 'Modules\Rent\Http\Controllers'], function()
{
	Route::get('/', 'RentController@index');
	Route::post('/',['as'=>'rent.store', 'uses'=>'RentController@store']);
	Route::get('show/{id}','RentController@show');
	Route::get('getScheduleDay/{tanggal}','RentController@getScheduleDay');
	Route::post('destroy',['as'=>'rent.destroy','uses'=>'RentController@destroy']);
	Route::group(['after'=>'transaction'], function(){
		Route::get('transaction','RenttransactionController@index');
		Route::get('transaction/getAllTransaction','RenttransactionController@getAllTransaction');
		Route::post('transaction/editStatus',['as'=>'rent.transaction.editStatus','uses'=>'RenttransactionController@editStatus']);
		Route::get('transaction/detail/{id}',['as'=>'rent.transaction.detail', 'uses'=>'RenttransactionController@detail']);
	});
});