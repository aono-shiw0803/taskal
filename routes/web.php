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
Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function(){
  Route::get('/', 'UserController@index')->name('index');
  Route::get('/{user}', 'UserController@show')->name('show');
  Route::get('/{user}/edit', 'UserController@edit')->name('edit');
  Route::put('/{user}', 'UserController@update')->name('update');
  Route::post('/delete/{id}', 'UserController@delete')->name('delete');
});

// Post
Route::group(['prefix' => 'posts', 'as' => 'posts.', 'middleware' => 'auth'], function(){
  Route::get('/', 'PostController@index')->name('index');
  Route::get('/create', 'PostController@create')->name('create');
  Route::post('/', 'PostController@store')->name('store');
  Route::get('/{post}', 'PostController@show')->name('show');
  Route::get('/{post}/edit', 'PostController@edit')->name('edit');
  Route::put('/{post}', 'PostController@update')->name('update');
  Route::post('/delete/{id}', 'PostController@delete')->name('delete');
});

// csv
Route::group(['prefix' => 'posts', 'middleware' => 'auth'], function(){
  Route::get('/csv', 'PostController@csv');
  Route::post('/csv', 'PostController@upload_regist');
  Route::get('/export_post', 'PostController@export_post')->name('export.post');
});

// -----conclusion-----
Route::group(['middleware' => 'auth'], function(){
  Route::get('/conclusions', 'ConclusionController@index');
  Route::get('/conclusions/export_conclution', 'ConclusionController@export_conclution')->name('export.conclution');
  Route::post('delete_post', 'ConclusionController@delete_post');
});

// Matter
Route::group(['prefix' => 'matters', 'as' => 'matters.', 'middleware' => 'auth'], function(){
  Route::get('/', 'MatterController@index')->name('index');
  Route::get('/create', 'MatterController@create')->name('create');
  Route::post('/', 'MatterController@store')->name('store');
  Route::get('/{matter}', 'MatterController@show')->name('show');
  Route::get('/{matter}/edit', 'MatterController@edit')->name('edit');
  Route::put('/{matter}', 'MatterController@update')->name('update');
  Route::post('/delete/{id}', 'MatterController@delete')->name('delete');
});

// File
Route::group(['prefix' => 'files', 'as' => 'files.', 'middleware' => 'auth'], function(){
  Route::get('/', 'FileController@index')->name('index');
  Route::get('/create', 'FileController@create')->name('create');
  Route::post('/', 'FileController@store')->name('store');
  Route::post('/delete/{id}', 'FileController@delete')->name('delete');
});

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
