<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('index',function(){
	return 'Api请求接口成功';
});

/******************************[首页]******************************/

//首页banner图接口
Route::any('home/banners','Api\HomeController@banners');
//首页最新小说接口
Route::post('home/news','Api\HomeController@newsList');
//点击排行
Route::post('home/clicks','Api\HomeController@clicksList');
//小说书单接口
Route::get('book/list','Api\NovelController@bookList');
//分类列表接口
Route::post('category/list','Api\CategoryController@getCategory');