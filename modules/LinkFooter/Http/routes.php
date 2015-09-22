<?php

Route::group(['prefix' => 'linkfooter', 'namespace' => 'Modules\LinkFooter\Http\Controllers'], function()
{
	Route::get('travel', 'LinkFooterController@travelSearch');
	Route::get('rent','LinkFooterController@rentSearch');
	Route::get('gettravelsearch','LinkFooterController@dataTravelSearch');
	Route::post('travelPost',['as'=>'linkfooter.travel.store', 'uses'=>'LinkFooterController@travelStore']);
	Route::post('deletelink',['as'=>'linkfooter.travel.destroy','uses'=>'LinkFooterController@travelDestroy']);

	Route::get('getrentsearch','LinkFooterController@dataRentSearch');
	Route::post('rentPost',['as'=>'linkfooter.rent.store', 'uses'=>'LinkFooterController@rentStore']);
	Route::post('deletelink',['as'=>'linkfooter.rent.destroy','uses'=>'LinkFooterController@rentDestroy']);

});