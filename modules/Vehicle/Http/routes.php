<?php

Route::group(['prefix' => 'vehicle', 'namespace' => 'Modules\Vehicle\Http\Controllers'], function()
{
	Route::get('getAllVehicle','VehicleController@getAllVehicle');
	Route::get('edit/{id}','VehicleController@edit');
	Route::post('edit','VehicleController@update');
	Route::post('hapus','VehicleController@destroy');
	Route::resource('/', 'VehicleController');

});