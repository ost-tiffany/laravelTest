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

Route::get('/home', ['uses'=>'HomeController@index', 'as'=>'home'])->middleware('auth');
Route::get('/login',['uses'=>'Auth\LoginController@index', 'as'=>'login']);
Route::post('/login',['uses'=>'Auth\LoginController@dologin', 'as'=>'dologin']);
Route::get('/mypage', ['uses'=>'UsersController@show', 'as'=>'mypage'])->middleware('auth');

Route::get('/register', ['uses'=>'Auth\RegisterController@index', 'as'=>'register']);
Route::post('/register', ['uses'=>'Auth\RegisterController@create', 'as'=>'register']);
Route::post('/logout', ['uses'=>'Auth\LoginController@logout', 'as'=>'logout']);

Route::get('/users', ['uses'=>'UsersController@index', 'as'=>'userlist'])->middleware('auth');
Route::get('users/edit/{user_id}', ['uses'=>'UsersController@update', 'as'=>'useredit'])->middleware('auth');
Route::post('users/edit/{user_id}', ['uses'=>'UsersController@update', 'as'=>'douseredit'])->middleware('auth');

Route::get('/products', ['uses'=>'ProductsController@index', 'as'=>'productlist'])->middleware('auth');

Route::get('/transaction', ['uses'=>'TransactionController@index', 'as'=>'transactionlist'])->middleware('auth');



// Auth::routes();
//middleware kek penengah saat mau manggil dan memperlihatkan gitu
