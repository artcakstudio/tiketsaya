<?php

Route::group(['prefix' => 'usermanagement', 'namespace' => 'Modules\Usermanagement\Http\Controllers'], function()
{
	Route::post('hapus','UsermanagementController@hapus');
	Route::controller('user', 'UsermanagementController', ['getUser' => 'datatables',]);
	Route::get('edit/{id}','UsermanagementController@edit');
	Route::post('edit',['as'=>'usermanagement.update', 'uses'=>'UsermanagementController@update']);
	Route::post('hapusrole', 'UsermanagementController@hapusRoleUser');
	Route::post('tambahRole', 'UsermanagementController@tambahRole');
	Route::resource('/', 'UsermanagementController');
	/*Route of roles*/
	Route::group(['after'=>'roles'],function(){
		Route::get('roles/listRoles','RolesController@getRoles');
		Route::post('roles/hapusHakAkses','RolesController@hapusHakAkses');
		Route::post('roles/tambahHakAkses','RolesController@tambahHakAkses');
		Route::resource('roles','RolesController');
		
	});
	
});