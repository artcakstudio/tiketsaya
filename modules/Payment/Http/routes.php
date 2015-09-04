<?php

Route::group(['prefix' => 'payment', 'namespace' => 'Modules\Payment\Http\Controllers'], function()
{
	Route::get('/', 'PaymentController@index');
});