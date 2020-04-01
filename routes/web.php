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
Route::get('users/edit/{user_id}/confirm', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmedit'])->middleware('auth'); 
Route::post('users/edit/{user_id}/confirmed', ['uses'=>'UsersController@confirmupdate', 'as'=> 'confirmeditpost'])->middleware('auth'); //confirmedit
Route::post('users/delete', ['uses'=>'UsersController@userdelete', 'as'=> 'deleteuser'])->middleware('auth'); //delete

Route::get('/products/item/{type_id?}', ['uses'=>'ProductsController@index', 'as'=>'productlist'])->middleware('auth'); //view product

Route::get('/products/add', ['uses'=>'ProductsController@addproduct', 'as'=>'productadd'])->middleware('auth'); //view add product
Route::post('/products/add', ['uses'=>'ProductsController@addproduct', 'as'=>'productaddpost'])->middleware('auth'); //add product
Route::get('/products/add/confirm', ['uses'=>'ProductsController@confirmproduct', 'as'=>'productaddsee'])->middleware('auth'); //view add product
Route::post('/products/add/confirmed', ['uses'=>'ProductsController@confirmproduct', 'as'=>'productaddconfirm'])->middleware('auth'); //confirm

Route::get('/products/edit/{product_id}', ['uses'=>'ProductsController@productedit', 'as'=>'productedit'])->middleware('auth'); //view edit product
Route::post('/products/edit/confirm/{product_id}', ['uses'=>'ProductsController@productedit', 'as'=>'producteditpost'])->middleware('auth'); //edit
Route::get('/products/edit/{product_id}/confirm', ['uses'=>'ProductsController@producteditconfirm', 'as'=>'producteditsee'])->middleware('auth'); //view edit product
Route::post('/products/edit/{product_id}/confirmed', ['uses'=>'ProductsController@producteditconfirm', 'as'=>'producteditconfirm'])->middleware('auth');

Route::post('/products/delete', ['uses'=>'ProductsController@productdelete', 'as'=>'productdelete'])->middleware('auth'); //delete product


Route::get('/transaction', ['uses'=>'TransactionController@index', 'as'=>'transactionlist'])->middleware('auth'); //mytransaction
Route::get('/transaction/detail/{transaction_id}', ['uses'=>'TransactionController@show', 'as'=>'transactiondetailview'])->middleware('auth'); //mytransaction
Route::get('/transaction/form',['uses'=>'TransactionController@make', 'as'=>'makeorder'])->middleware('auth'); //makeorder
Route::post('/transaction/form',['uses'=>'TransactionController@make', 'as'=>'makeorderpost'])->middleware('auth');
Route::get('/transaction/form/confirm',['uses'=>'TransactionController@makesure', 'as'=>'ordersure'])->middleware('auth');
Route::post('/transaction/form/confirmed',['uses'=>'TransactionController@makesure', 'as'=>'ordersureconfirm'])->middleware('auth');

Route::get('/transaction/edit/{transaction_id}',['uses' =>'TransactionController@editorder', 'as' => 'editorder'])->middleware('auth'); //edit transaction
Route::post('/transaction/edit/confirm/{transaction_id}',['uses' =>'TransactionController@editorder', 'as' => 'editorderpost'])->middleware('auth');
Route::get('/transaction/edit/{transaction_id}/confirm',['uses' =>'TransactionController@editorderconfirm', 'as' => 'editorderpostviewconfirm'])->middleware('auth'); //edit confirmation
Route::post('/transaction/edit/{transaction_id}/confirmed',['uses' =>'TransactionController@editorderconfirm', 'as' => 'editorderconfirm'])->middleware('auth');

Route::post('/transaction/delete',['uses' =>'TransactionController@delete', 'as' => 'deleteorder'])->middleware('auth'); //delete and cancel transaction

// Auth::routes();
//middleware kek penengah saat mau manggil dan memperlihatkan gitu
