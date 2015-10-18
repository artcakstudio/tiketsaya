<?php

Route::group(['prefix' => 'ticketpartner', 'namespace' => 'Modules\TicketPartner\Http\Controllers'], function()
{
	Route::get('/', 'TicketPartnerController@index');
	Route::get('list-booking','TicketPartnerController@list_booking');
	Route::get('get_list_booking','TicketPartnerController@get_list_boking');
});