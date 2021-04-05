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

Route::get('/','SettingController@getConnect');
Route::group(['prefix'=>'dashboard'],function(){
    Route::get('/','PagesController@getIndex');
});
Route::group(['prefix'=>'product'],function(){
    Route::get('/product-list','ProductController@getProduct');
    Route::get('/details/{id}','ProductController@getProductDetails');
});
Route::group(['prefix'=>'setting'],function(){
    Route::get('/connect','SettingController@getConnect');
    Route::post('/connect','SettingController@postConnect');
});
Route::group(['prefix'=>'retailer'],function(){
    Route::get('/info-retailer','RetailerController@getRetailer');
});
Route::group(['prefix'=>'customer'],function(){
    Route::get('/list-customer','CustomerController@getCustomer');
    Route::get('/details/{id}','CustomerController@getDetailsCustomer');
    Route::post('/create','CustomerController@postCreateCtm');
    Route::post('/update/{id}','CustomerController@postUpdateCtm');
    Route::get('/delete/{id}','CustomerController@getDeleteCtm');
});
Route::group(['prefix'=>'categories'],function(){
    Route::get('/list-categories','CategoryController@getCategory');
    Route::post('/create','CategoryController@postCreateCategory');
    Route::post('/update/{id}','CategoryController@postUpdateCategory');
    Route::get('/delete/{id}','CategoryController@getDeteleCategory');
});
Route::group(['prefix'=>'order'],function(){
    Route::get('/list-order','OrderController@getOrder');
    Route::get('/details/{id}','OrderController@getDetails');
    Route::post('/create','OrderController@postCreateOd');
    Route::post('/update/{id}','OrderController@postUpdateOd');
    Route::get('/delete/{id}','OrderController@getDeleteOd');
    Route::post('/selectCustomer','OrderController@postSelect');
});

