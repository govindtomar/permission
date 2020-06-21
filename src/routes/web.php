<?php

Route::group(['namespace' => 'GovindTomar\Permission\Http\Controllers'], function(){

	// Role Controller Routes
	Route::get('admin/role/create', 'RoleController@create');
	Route::post('admin/role', 'RoleController@store');
	Route::get('admin/role', 'RoleController@index');
	Route::get('admin/role/{id}', 'RoleController@show');
	Route::get('admin/role/{id}/edit', 'RoleController@edit');
	Route::put('admin/role', 'RoleController@update');
	Route::delete('admin/role/{id}','RoleController@destroy');

	// Permission Controller Routes
	Route::get('admin/permission/create', 'PermissionController@create');
	Route::post('admin/permission', 'PermissionController@store');
	Route::get('admin/permission', 'PermissionController@index');
	Route::get('admin/permission/{id}', 'PermissionController@show');
	Route::get('admin/permission/{id}/edit', 'PermissionController@edit');
	Route::put('admin/permission', 'PermissionController@update');
	Route::delete('admin/permission/{id}','PermissionController@destroy');
	Route::post('admin/role-permission/add-new', 'PermissionController@role_permission_add_new');
	Route::get('admin/role-permission/{url}', 'PermissionController@role_permission_index');
	Route::put('admin/role-permission/{url}', 'PermissionController@role_permission_update');
});
	