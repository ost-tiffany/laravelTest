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

Route::get('/home', ['uses'=>'HomeController@index', 'as'=>'home'])->middleware('auth'); //login
Route::get('/login',['uses'=>'Auth\LoginController@index', 'as'=>'login']);
Route::post('/login',['uses'=>'Auth\LoginController@dologin', 'as'=>'dologin']);
Route::get('/mypage', ['uses'=>'UsersController@show', 'as'=>'mypage'])->middleware('auth'); //logged in account
Route::post('/logout', ['uses'=>'Auth\LoginController@logout', 'as'=>'logout']); //logout

Route::get('/register', ['uses'=>'Auth\RegisterController@index', 'as'=>'register']); //register
Route::post('/register', ['uses'=>'Auth\RegisterController@create', 'as'=>'register']);

Route::get('/users', ['uses'=>'UsersController@index', 'as'=>'userlist'])->middleware('auth'); //view user
Route::get('users/edit/{user_id}', ['uses'=>'UsersController@update', 'as'=>'useredit'])->middleware('auth'); //edit
Route::post('users/edit/{user_id}', ['uses'=>'UsersController@update', 'as'=>'douseredit'])->middleware('auth');
Route::get('users/edit/{user_id}/confirm', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmedit'])->middleware('auth'); //confirmedit
Route::post('users/edit/{user_id}/confirmed', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmeditpost'])->middleware('auth');
Route::post('users/delete', ['uses'=>'UsersController@userdelete', 'as'=> 'deleteuser'])->middleware('auth'); //delete

Route::get('/products', ['uses'=>'ProductsController@index', 'as'=>'productlist'])->middleware('auth'); //view product
Route::get('products/wood', ['uses'=>'ProductsController@wood', 'as'=>'woodlist'])->middleware('auth'); //woodlist
Route::get('products/other', ['uses'=>'ProductsController@other', 'as'=>'otherlist'])->middleware('auth'); //otherlist

Route::post('/addproduct', ['uses'=>'ProductsController@add', 'as'=>'addproduct'])->middleware('auth');//add product

Route::get('/transaction', ['uses'=>'TransactionController@index', 'as'=>'transactionlist'])->middleware('auth'); //transaction



// Auth::routes();
//middleware kek penengah saat mau manggil dan memperlihatkan gitu
