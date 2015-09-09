<?php

Route::group(['prefix' => 'travel', 'namespace' => 'Modules\Travel\Http\Controllers'], function()
{
	Route::get('getScheduleDay/{id}','TravelController@getScheduleDay');
	Route::get('show/{tanggal}','TravelController@show');
	Route::post('update',['as'=>'travel..update', 'uses'=>'TravelController@update']);
	Route::post('destroy', ['as'=>'travel..delete',  'uses'=>'TravelController@destroy']);
	Route::resource('/', 'TravelController');
	Route::group(['after'=>'route'],function(){
		Route::get('route/getAllRoute','RouteController@getAllRoute');
		Route::post('route/update','RouteController@update');
		Route::post('route/destroy','RouteController@destroy');
		Route::resource('route','RouteController');
	});
	Route::group(['after'=>'transaction'],function(){
		Route::get('transaction/getAllTransaction','TraveltransactionController@getAllTransaction');
		Route::get('transaction','TraveltransactionController@index');
		Route::post('transaction/editStatus',['as'=>'travel.transaction.editStatus','uses'=>'TraveltransactionController@editStatus']);
		Route::get('transaction/detail/{id}',['as'=>'trave.transaction.detail', 'uses'=>'TraveltransactionController@detail']);
	});
});