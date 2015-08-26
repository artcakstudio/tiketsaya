<?php

Route::group(['prefix' => 'travelpage', 'namespace' => 'Modules\Travelpage\Http\Controllers'], function()
{
	Route::get('/', 'TravelpageController@index');
	Route::post('searchTravel',['as'=>'travelpage.search','uses'=>'TravelpageController@scheduleSearch']);
});