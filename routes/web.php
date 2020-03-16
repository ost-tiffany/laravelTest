<?php

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

Route::get('/login',['uses'=>'Auth\LoginController@index', 'as'=>'login']);
Route::post('/login',['uses'=>'Auth\LoginController@dologin', 'as'=>'dologin']);

Route::get('/register', ['uses'=>'Auth\RegisterController@index', 'as'=>'register']);

Route::get('/users', ['uses'=>'UsersController@index', 'as'=>'userlist']);
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
