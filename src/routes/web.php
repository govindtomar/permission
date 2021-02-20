<?php
use GovindTomar\Permission\Helper\Helper;

Route::group(['namespace' => 'GovindTomar\Permission\Http\Controllers'], function(){
	$route = Helper::route();
    $name = Helper::routeName();

	// Role Controller Routes
	Route::get($route.'role/create', 'RoleController@create')->name($name.'role.create');
	Route::post($route.'role', 'RoleController@store')->name($name.'role.store');
	Route::get($route.'role', 'RoleController@index')->name($name.'role.index');
	Route::get($route.'role/{id}', 'RoleController@show')->name($name.'role.show');
	Route::get($route.'role/{id}/edit', 'RoleController@edit')->name($name.'role.edit');
	Route::put($route.'role', 'RoleController@update')->name($name.'role.update');
	Route::delete($route.'role/{id}','RoleController@destroy')->name($name.'role.destroy');

	// Permission Controller Routes
	Route::get($route.'permission/create', 'PermissionController@create')->name($name.'permission.create');
	Route::post($route.'permission', 'PermissionController@store')->name($name.'permission.create');
	Route::get($route.'permission', 'PermissionController@index')->name($name.'permission.create');
	Route::get($route.'permission/{id}', 'PermissionController@show')->name($name.'permission.create');
	Route::get($route.'permission/{id}/edit', 'PermissionController@edit')->name($name.'permission.create');
	Route::put($route.'permission', 'PermissionController@update')->name($name.'permission.create');
	Route::delete($route.'permission/{id}','PermissionController@destroy')->name($name.'permission.create');

	// Role Permissions
	Route::post($route.'role/permission/add-new', 'RolePermissionController@role_permission_add_new')->name($name.'role.permission.create');
	Route::get($route.'role/permission/{url}', 'RolePermissionController@role_permission_index')->name($name.'role.permission.index');
	Route::put($route.'role/permission/{url}', 'RolePermissionController@role_permission_update')->name($name.'role.permission.store');

	// User Permissions Comming Soon
});
