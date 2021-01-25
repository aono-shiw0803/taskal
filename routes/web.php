<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
  if(Auth::user()){
    return redirect('/posts');
  } else {
    return redirect('/login');
  }
});

// User
Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('auth');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('auth');
Route::post('/users/delete/{id}', 'UserController@delete')->name('users.delete')->middleware('auth');

// Post
Route::get('/posts/csv', 'PostController@csv')->middleware('auth');
Route::post('/posts/csv', 'PostController@upload_regist')->middleware('auth');
Route::get('/posts/export_post', 'PostController@export_post')->name('export.post')->middleware('auth');
Route::get('/posts', 'PostController@index')->name('posts.index')->middleware('auth');
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', 'PostController@update')->name('posts.update')->middleware('auth');
Route::post('/posts/delete/{id}', 'PostController@delete')->name('posts.delete')->middleware('auth');

// -----conclusion-----
Route::get('/conclusions', 'ConclusionController@index')->middleware('auth');
Route::get('/conclusions/export_conclution', 'ConclusionController@export_conclution')->name('export.conclution')->middleware('auth');
Route::post('delete_post', 'ConclusionController@delete_post')->middleware('auth');

// Matter
Route::get('/matters', 'MatterController@index')->name('matters.index')->middleware('auth');
Route::get('/matters/create', 'MatterController@create')->name('matters.create')->middleware('auth');
Route::post('/matters', 'MatterController@store')->name('matters.store')->middleware('auth');
Route::get('/matters/{matter}', 'MatterController@show')->name('matters.show')->middleware('auth');
Route::get('/matters/{matter}/edit', 'MatterController@edit')->name('matters.edit')->middleware('auth');
Route::put('/matters/{matter}', 'MatterController@update')->name('matters.update')->middleware('auth');
Route::post('/matters/delete/{id}', 'MatterController@delete')->name('matters.delete')->middleware('auth');

// File
Route::get('/files', 'FileController@index')->name('files.index')->middleware('auth');
Route::get('/files/create', 'FileController@create')->name('files.create')->middleware('auth');
Route::post('/files', 'FileController@store')->name('files.store')->middleware('auth');
Route::post('/files/delete/{id}', 'FileController@delete')->name('files.delete')->middleware('auth');

// Auth::routes();
// ↑下記のルーティングを使用しない場合はコメントアウトを解除する。
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth', 'can:admin']], function () {
  //ユーザー登録
  Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'Auth\RegisterController@register');
});

// Route::get('/home', 'HomeController@index')->name('home');
