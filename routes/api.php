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

Route::any("/index",function(){
    $return = [
        "code" =>2000,
        "msg" => "成功"
    ];
    return json_encode($return);
});

//首页banner图
Route::post("/banners/list","Api\HomeController@banners");
//首页最新小说
Route::post("/newsnovel/list","Api\HomeController@newsNovel");
//首页点击数量最高的小说
Route::post("/clicks/list","Api\HomeController@clicksList");


//获取小说书库
Route::post("/novel/list","Api\NovelController@novelList");

//获取分类列表
Route::post("/category/list","Api\CategoryController@categoryList");
//根据小说分类获取小说列表
Route::post("/category/novel","Api\CategoryController@novelList");

//根据名称获取小说列表
Route::post("/search/novel","Api\SearchController@getNovelList");

//小说阅读排行
Route::post("/read/rank","Api\NovelController@readRank");
//小说详情页
Route::post("/detail/list/{novelId}","Api\DetailController@detailList");

//小说章节
Route::post("/chapter/list/{novelId}","Api\ChapterController@getChapterList");
//小说章节内容
Route::post("/chapter/info/{id}","Api\ChapterController@chapterContent");

//修改小说点击数
Route::post("/clicks/update/{id}","Api\NovelController@clicks");

//评论添加
Route::post("/comment/add","Api\CommentController@add");
//评论列表
Route::post("/comment/list/{novelId}","Api\CommentController@list");
//评论删除
Route::post("/comment/del/{id}","Api\CommentController@del");
