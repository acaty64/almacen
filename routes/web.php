<?php

// use Illuminate\Support\Facades\Request;
use App\Drive;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;




Route::get('/tests/index/{id}',[
	'as' => 'check.index',
	'uses' => 'CheckController@index'
]);

Route::get('/tests/annotation/{user_id}/{file_id}',[
	'as' => 'file.annotation',
	'uses' => 'Api\FileController@annotation'
]);

Route::get('/tests/pdfoutfile',[
	'as' => 'doc.pdfoutfile',
	'uses' => 'DocController@pdfoutfile'
]);

Route::get('/tests/multiplepdf',[
	'as' => 'doc.viewmultiplepdf',
	'uses' => 'DocController@viewmultiplepdf'
]);

Route::post('/tests/multiplepdf',[
	'as' => 'doc.multiplepdf',
	'uses' => 'DocController@multiplepdf'
]);

Route::get('/tests/vue', function()
{
	return view('vueTest')->with(['user_id'=>1]);
});

Route::get('/tests', function()
{
	return view('test');
});

Route::get('/tests/read/{googleFileId}', 'DocController@read'); // read file

Route::get('/autologin/{id}/{api_token}', [
	'as' => 'autologin',
	'uses' => 'LoginController@autologin'
]);

// Route::get('/login/handle/{token}', [
// 	'as' => 'login.handle',
// 	'uses' => 'LoginController@handle'
// ]);

Route::get('/drive', 'DriveController@getDrive'); // retreive folders
 
Route::get('/drive/upload', 'DriveController@uploadFile'); // File upload form
 
Route::post('/drive/upload', 'DriveController@uploadFile'); // Upload file to Drive from Form
 
Route::get('/drive/create', 'DriveController@create'); // Upload file to Drive from Storage
 
Route::get('/drive/delete/{id}', 'DriveController@deleteFile'); // Delete file or folder


// Route::get('/example', function ()
// {
// 	dd('route');
// });
Route::get('/example', [ 'uses' => 'ExampleController@show'
]);

Route::get('/', function () {
	// return redirect('/welcome');
	return redirect('/login');
});

Route::get('/welcome', function () {
    return view('welcome');
});


// Route::get('/login', 'LoginController@redirectToGoogle')->name('login');

// Route::get('/login/callback', 'LoginController@handleGoogleCallback');

Route::post('/logout', [
	'as' => 'logout',
	'uses' => 'Auth\LoginController@logout'
]);

Route::get('/login', function()
{
	return "<a href='" . env("APP_URL_USER") . "'>Debe acceder por este enlace.</a>";
})->name('login');

if(config('app.debug')){
	Auth::routes();
}

// Route::get('/home', function () {
//     return view('home');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', [
	'as' => 'home',
	'uses' => 'HomeController@index',
]);

Route::get('/access', [
	'as' => 'access.panel',
	'uses' => 'AccessController@panel',
]);

Route::post('/access/save', [
	'as' => 'access.save',
	'uses' => 'AccessController@save',
]);
