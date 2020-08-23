<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



Route::get('operador/dashboard', [
	'as' => 'operador.dashboard',
	'uses' => 'OperadorController@dashboard',
]);

Route::get('/docs/index', [
	'as' => 'docs.index',
	'uses' => 'DocController@index',
]);

Route::get('/docs/show/{doc_id}', [
	'as' => 'docs.show',
	'uses' => 'DocController@show',
]);

Route::get('/docs/create', [
	'as' => 'docs.create',
	'uses' => 'DocController@create',
]);

Route::post('/docs/store', [
	'as' => 'docs.store',
	'uses' => 'DocController@store',
]);
