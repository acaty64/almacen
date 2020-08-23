<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Route::get('', [
// 	'as' => '',
// 	'uses' => '',
// ]);

Route::get('access/create', [
	'as' => 'access.create',
	'uses' => 'AccessController@create',
]);

Route::get('access/edit/{id}', [
	'as' => 'access.edit',
	'uses' => 'AccessController@edit',
]);

Route::post('access/update', [
	'as' => 'access.update',
	'uses' => 'AccessController@update',
]);

Route::get('access/destroy/{id}', [
	'as' => 'access.destroy',
	'uses' => 'AccessController@destroy',
]);

Route::get('access/index/{user_id}', [
	'as' => 'access.index',
	'uses' => 'AccessController@index',
]);

Route::post('access/store', [
	'as' => 'access.store',
	'uses' => 'AccessController@store',
]);


Route::get('/docs/nulled/{doc_id}', [
	'as' => 'docs.nulled',
	'uses' => 'DocController@nulled',
]);

Route::get('/reports', [
	'as' => 'reports.index',
	'uses' => 'ReportController@index',
]);

Route::post('/reports/show', [
	'as' => 'reports.show',
	'uses' => 'ReportController@show',
]);

Route::get('admin/dashboard', [
	'as' => 'admin.dashboard',
	'uses' => 'AdminController@dashboard',
]);

Route::get('user/index', [
	'as' => 'user.index',
	'uses' => 'UserController@index',
]);

Route::get('user/create', [
	'as' => 'user.create',
	'uses' => 'UserController@create',
]);

Route::post('user/store', [
	'as' => 'user.store',
	'uses' => 'UserController@store',
]);

Route::get('user/edit/{id}', [
	'as' => 'user.edit',
	'uses' => 'UserController@edit',
]);

Route::post('user/update', [
	'as' => 'user.update',
	'uses' => 'UserController@update',
]);

Route::delete('user/destroy/{id}', [
	'as' => 'user.destroy',
	'uses' => 'UserController@destroy',
]);

