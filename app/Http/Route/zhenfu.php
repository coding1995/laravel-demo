<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', function () { 

	return view('admin.index');
});

Route::get('admin/orders', function () { 

	return view('admin.orders');
});
