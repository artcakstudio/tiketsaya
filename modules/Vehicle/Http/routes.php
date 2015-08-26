<?php

Route::group(['prefix' => 'vehicle', 'namespace' => 'Modules\Vehicle\Http\Controllers'], function()
{
	Route::get('getAllVehicle','VehicleController@getAllVehicle');
	Route::get('edit/{id}','VehicleController@edit');
	Route::post('edit','VehicleController@update');
	Route::post('hapus','VehicleController@destroy');
	Route::resource('/', 'VehicleController');
	Route::group(['after'=>'city'],function(){
		Route::post('city/edit','CityController@edit');
		Route::post('city/update','CityController@update');
		Route::post('city/destroy','CityController@destroy');
		Route::get('city/getAllCity','CityController@getAllCity');
		Route::resource('city','CityController');
	});
	Route::group(['after'=>'partner'],function(){
		Route::get('partner','PartnerController@index');
		Route::get('partner/getAllPartner','PartnerController@getAllPartner');
		Route::post('partner/addPartner',['as'=>'vehicle.partner.store','uses'=>'PartnerController@store']);	
		Route::get('partner/edit/{id}','PartnerController@edit');
		Route::post('partner/edit',['as'=>'vehicle.partner.update', 'uses'=>'PartnerController@update']);
		Route::post('partner/destroy',['as'=>'vehicle.partner.store','uses'=>'PartnerController@destroy']);
	});
});