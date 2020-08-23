<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


Route::get('firmante/dashboard', [
	'as' => 'firmante.dashboard',
	'uses' => 'FirmanteController@dashboard',
]);

Route::get('/sign/check/{doc_id}', [
	'as' => 'sign.check',
	'uses' => 'SignController@check',
]);

Route::get('/sign/check/ok/{doc_id}', [
	'as' => 'sign.check.ok',
	'uses' => 'SignController@checkOk',
]);

Route::get('/sign/check/ko', [
	'as' => 'sign.check.ko',
	'uses' => 'SignController@checkKo',
]);

Route::get('/sign/uncheck/{doc_id}', [
	'as' => 'sign.uncheck',
	'uses' => 'SignController@uncheck',
]);

Route::get('/sign/uncheck/ok/{doc_id}', [
	'as' => 'sign.uncheck.ok',
	'uses' => 'SignController@uncheckOk',
]);

Route::get('/sign/uncheck/ko', [
	'as' => 'sign.uncheck.ko',
	'uses' => 'SignController@uncheckKo',
]);

Route::get('/sign/index', [
	'as' => 'sign.index',
	'uses' => 'SignController@index',
]);

// Route::get('/sign/index', function($value='')
// {
// 	dd('route');
// })->name('sign.index');