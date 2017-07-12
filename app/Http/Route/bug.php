<?php




Route::get('/admin', 'AdminController@index');

Route::get('admin/orders/upstate', 'OrdersController@upstate');

Route::get('admin/collect', 'CollectController@index');
// Route::resource('admin/comment', 'CommentController');
Route::get('/collect', 'webCollectController@show');
Route::get('/outcollect/{id}', 'webCollectController@del');


Route::get('/collect/{id}', 'webCollectController@index');

Route::resource('admin/orders', 'OrdersController');


Route::any('admin/ordersdetail/{id}', 'OrdersDetailController@show');


Route::post('/adcart', 'ShopCarController@add');

Route::get('/cart', 'ShopCarController@show');

Route::get('/addnum/{id}', 'ShopCarController@addNum');
Route::get('/cutnum/{id}', 'ShopCarController@cutNum');
Route::get('/shopdel/{id}', 'ShopCarController@shopDel');

Route::any('/addorder/{id}', 'ShopCarController@addOrder');

Route::post('/loworder', 'ShopCarController@lowOrder');

Route::get('/order', 'webOrderController@index');

Route::get('/orders/upstates', 'webOrderController@upstate');
Route::get('/orders/del', 'webOrderController@del');
// Route::get('/pay', 'ShopCarController@');


