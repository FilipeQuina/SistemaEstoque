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



Route::get('/products', 'ProductsController@index');
Route::get('/product/novo', 'ProductsController@novo');
Route::post('/product/store', 'ProductsController@store');
Route::get('/product/edit/{id}', 'ProductsController@edit');
Route::post('/product/update/{id}', 'ProductsController@update');
Route::get('/product/destroy/{id}', 'ProductsController@destroy');

Route::group(['middleware'=>'web'], function (){
    Route::get('/','HomeController@index');
    Auth::routes();
    Route::get('/home', 'HomeController@index');
});

Route::get('/sales', function () {
    return view('sales.lista');
});
