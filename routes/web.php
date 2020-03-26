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
//Route::get('users/edit/{user_id}/confirm', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmedit'])->middleware('auth'); 
Route::post('users/edit/{user_id}/confirmed', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmeditpost'])->middleware('auth'); //confirmedit
Route::post('users/delete', ['uses'=>'UsersController@userdelete', 'as'=> 'deleteuser'])->middleware('auth'); //delete

Route::get('/products', ['uses'=>'ProductsController@index', 'as'=>'productlist'])->middleware('auth'); //view product
Route::get('products/wood', ['uses'=>'ProductsController@wood', 'as'=>'woodlist'])->middleware('auth'); //woodlist
Route::get('products/other', ['uses'=>'ProductsController@other', 'as'=>'otherlist'])->middleware('auth'); //otherlist

Route::get('/products/add', ['uses'=>'ProductsController@addproduct', 'as'=>'productadd'])->middleware('auth'); //view add product
Route::post('/products/add', ['uses'=>'ProductsController@addproduct', 'as'=>'productaddpost'])->middleware('auth'); //add product
Route::post('/products/add/confirm', ['uses'=>'ProductsController@confirmproduct', 'as'=>'productaddconfirm'])->middleware('auth'); //confirm

Route::get('/products/edit/{product_id}', ['uses'=>'ProductsController@productedit', 'as'=>'productedit'])->middleware('auth'); //view edit product
Route::post('/products/edit/confirm/{product_id}', ['uses'=>'ProductsController@productedit', 'as'=>'producteditpost'])->middleware('auth');
Route::post('/products/edit/{product_id}/confirmed', ['uses'=>'ProductsController@producteditconfirm', 'as'=>'producteditconfirm'])->middleware('auth');


Route::post('/products/delete', ['uses'=>'ProductsController@productdelete', 'as'=>'productdelete'])->middleware('auth'); //delete product


Route::get('/transaction', ['uses'=>'TransactionController@index', 'as'=>'transactionlist'])->middleware('auth'); //mytransaction
Route::get('/transaction/form',['uses'=>'TransactionController@make', 'as'=>'makeorder'])->middleware('auth'); //makeorder



// Auth::routes();
//middleware kek penengah saat mau manggil dan memperlihatkan gitu
