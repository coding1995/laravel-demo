<?php

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => 'admin'], function(){


Route::get('/admin', function () {

	return view('admin.index');
});

//后台商品分类路由
Route::resource('/admin/goods', 'GoodsController');

//后台商品路由
Route::get('/admin/shop', 'ShopController@index');

Route::get('/admin/shop/add', 'ShopController@add');

Route::post('/admin/shop/insert', 'ShopController@insert');

Route::get('/admin/shop/edit/{id}', 'ShopController@edit');

Route::post('/admin/shop/update', 'ShopController@update');

Route::post('/admin/shop/del/{id}', 'ShopController@destroy');

//后台友情链接路由
Route::resource('/admin/link', 'LinkController');

//后台商品属性路由
Route::resource('/admin/attributes', 'AttributesController');

//后台轮播图路由
Route::resource('/admin/carousel', 'CarouselController');
});




//前台路由
Route::get('/', 'Web\WebController@index');//首页

Route::get('/weba/{id}', 'Web\WebController@detail');//商品详情

Route::get('/list', 'Web\WebController@list');//商品列表

Route::post('/list/{id}', 'Web\WebController@ajax');//ajax请求

Route::post('/ajax/{id}', 'Web\WebController@search');//ajax请求

