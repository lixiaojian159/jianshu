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

Route::get('/', function () {
    return view('welcome');
});

//注册页面
Route::get('/register','RegisterController@index');
//注册逻辑
Route::post('/register','RegisterController@register');

//登录页面
Route::get('/login','LoginController@index')->name('login');
//登录逻辑
Route::post('/login','LoginController@login');
//退出
Route::get('logout','LoginController@logout');

//个人设置页面
Route::get('/user/me/setting','UserController@setting');
//个人设置逻辑
Route::post('/user/me/setting','UserController@settingstore');

//文章列表页
Route::get('/posts','PostController@index');
//文章详情页
Route::get('/posts/{id}/show','PostController@show');
//创建文章页
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');
//编辑文章页
Route::get('/posts/{id}/edit','PostController@edit');
Route::put('/posts/{id}','PostController@update');
//删除文章
Route::get('/posts/{id}/delete','PostController@delete');
//上传图片
Route::post('/posts/image/upload','PostController@imageUpload');
//添加评论逻辑
Route::post('/posts/{post}/comment','PostController@comment');

//测试
Route::get('/test','PostController@test');
//测试容器类
Route::get('/test/app','TestController@test_app');
Route::get('/test/auth','TestController@test_auth');