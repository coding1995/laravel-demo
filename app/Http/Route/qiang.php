<?php

//Route::get('/', function () {
//    return view('welcome');
//});
//后台路由
//角色表
Route::get('admin/role', 'Admin\RoleController@index');
//角色添加页面
Route::get('admin/role/create', 'Admin\RoleController@create');
//角色处理添加
Route::post('admin/role/store', 'Admin\RoleController@store');
//角色修改页面
Route::get('admin/role/{id}/edit', 'Admin\RoleController@edit');
//角色修改页面
Route::post('admin/role/update/{id}', 'Admin\RoleController@update');
//角色页面设置权限页面
Route::get('admin/role/setaccess/{id}', 'Admin\RoleController@setaccess');
//角色页面设置权限处理
Route::post('admin/role/accessstore', 'Admin\RoleController@accessstore');
//ajax查询数据库管理员用户
Route::any('role/showuser', 'Admin\RoleController@showuser');



//权限表
Route::get('admin/access', 'Admin\AccessController@index');
//权限添加页面
Route::get('admin/access/create', 'Admin\AccessController@create');
//角色处理添加
Route::post('admin/access/store', 'Admin\AccessController@store');
//权限修改页面
Route::get('admin/access/{id}/edit', 'Admin\AccessController@edit');
//权限修改处理
Route::post('admin/access/update/{id}', 'Admin\AccessController@update');
//无权限报错路由
Route::any('admin/accesserrors', 'Admin\AccessController@accesserrors');
//ajax查询数据库管理员用户
Route::any('access/showuser', 'Admin\AccessController@showuser');


	//登录后台页面
	Route::get('admin/login', 'Admin\LoginController@login');
	//后台登录处理
	Route::any('admin/store', 'Admin\LoginController@store');
	//验证码
	Route::any('admin/captcha', 'Admin\LoginController@captcha');
	//后台注销路由
	Route::get('admin/logout', 'Admin\LoginController@logout');


Route::group([  'middleware' => 'admin' ,'namespace' => 'Admin', 'prefix' => 'admin'], function(){
	//后台首页路由
	Route::get('/', 'LoginController@index');

    //管理员会员增删，改查
	Route::resource('user', 'UserController');
	//文件上传
	Route::any('upload', 'UserController@upload');

    //ajax查询数据库管理员用户
	Route::any('showuser', 'UserController@showuser');
    //前台ajax请求
	Route::any('showusers', 'WebUserController@showusers');
    //管理员用户查询
	Route::any('search', 'UserController@search');
    //会员表
	Route::resource('webuser','WebUserController');
    //会员查询
	Route::any('searchs', 'WebUserController@searchs');

});

//前台路由

	//前台登录
	Route::get('web/login', 'Web\LoginController@login');
    //注销登录
    Route::get('web/logout', 'Web\LoginController@logout');
	//登录处理
	Route::post('web/store', 'Web\LoginController@store');
	//注册页面
	Route::get('web/register', 'Web\LoginController@register');
	//注册用户
	Route::post('web/create', 'Web\LoginController@create');
	//ajax请求
	Route::any('web/showusers', 'Web\LoginController@showusers');
	//跳转激活帐号
	Route::any('web/verify/{token}', 'Web\LoginController@tokenemail');
	//通过邮箱找回密码
	Route::get('web/forget', 'Web\LoginController@forget');
	//处理传输过来的帐号
	Route::post('web/doforget', 'Web\LoginController@doforget');
	//邮箱跳转密码重置
	Route::any('web/reset/{token}', 'Web\LoginController@resetemail');
	//处理密码重置问题
	Route::post('web/doreset', 'Web\LoginController@doreset');

Route::group([ 'middleware' => 'weblist' , 'namespace'=>'Web', 'prefix'=>'web'], function(){
	//个人中心
	Route::resource('user', 'UserController');
	//访问收获地址页面
	Route::any('address', 'AddressController@index');
	//收货地址添加
	Route::post('insert', 'AddressController@insert');
	//删除新增地址
	Route::get('delete/{id}', 'AddressController@delete');
	//修改用户地址信息
	Route::get('addressedit/{id}', 'AddressController@addressedit');
	//处理修改用户地址信息
	Route::post('addressupdate/{id}', 'AddressController@addressupdate');
    //三级联动
	Route::any('addressshow', 'AddressController@addressshow');
	//头像上传
	Route::any('picupload/{uid}', 'UserController@picupload');
	//图片处理
	Route::any('showupdate/{uid}', 'UserController@showupdate');
	//修改密码页面
	Route::any('password', 'UserController@password');
    //帐号安全
	Route::any('safety', 'UserController@safety');
	//修改密码
	Route::any('passwordupdate', 'UserController@passwordupdate');

});
