<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Route::get('', [
// 	'as' => '',
// 	'uses' => '',
// ]);

// Route::get('master/dashboard', function()
// {
// 	dd('route master.dashboard');
// })->name('master.dashboard');
Route::get('master/dashboard', [
	'as' => 'master.dashboard',
	'uses' => 'MasterController@dashboard',
]);

Route::get('/backup', [ 
	'as' => 'backup.index',
	'uses' => 'Sys\BackupController@index',
]);

Route::get('/backup/create', [ 
	'as' => 'backup.create',
	'uses' => 'Sys\BackupController@create',
]);

Route::get('/backup/download/{filename}', [ 
	'as' => 'backup.download',
	'uses' => 'Sys\BackupController@download',
]);

Route::get('/backup/destroy/{filename}', [ 
	'as' => 'backup.destroy',
	'uses' => 'Sys\BackupController@destroy',
]);
