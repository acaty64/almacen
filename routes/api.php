<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/check/getdata/{user_id}', [
	'as' => 'check.getdata',
	'uses' => 'Api\CheckController@getdata'
]);

Route::get('/check/setcheck/{user_id}', [
	'as' => 'check.setcheck',
	'uses' => 'Api\CheckController@setcheck'
]);

Route::post('/doc/jpgToPdf', [
	'as' => 'doc.jpgToPdf',
	'uses' => 'Api\DocController@jpgToPdf'
]);


Route::get('/checkpdf/{id}', [
	'as' => 'check.pdf',
	'uses' => 'Api\CheckController@pdf'
]);

Route::post('/guide', [
	'as' => 'guide.init',
	'uses' => 'Api\GuideController@init'
]);

Route::post('/guide/sign', [
	'as' => 'guide.sign',
	'uses' => 'Api\GuideController@sign'
]);

Route::post('/doc/saveBack', [
	'as' => 'doc.saveBack',
	'uses' => 'Api\DocController@saveBack'
]);

Route::post('/doc/preview', [
	'as' => 'doc.preview',
	'uses' => 'Api\DocController@preview'
]);

// Route::post('/guide', function(Request $request)
// {
// 	return ['filebase' => 'page.jpg'];
// });