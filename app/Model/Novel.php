<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    //
    protected $table = "novel";

    //获取列表
    public function getList(){

    	return self::select("novel.id",'c_name','author_name','c_id','a_id','name','image_url','status')
    			->join('category','novel.c_id','category.id')//连分类表
    			->join('author','novel.a_id','=','author.id')
    			->paginate(5);
    }


    //小说添加
    public function addRecord($data){
    	
    	return self::insert($data);
    }

    // 执行删除操作
    public function delRecord($id){
    	return self::where('id',$id)->delete();
    }

    //小说修改
    public function editRecord($data, $id)
    {
    	return self::where('id',$id)->update($data);    
    }


     //获取小说详情
    public function getNovelInfo($id)
    {
    	return self::where('id', $id)->first();
    }




    //获取小程序首页的banner图
    public function getBanners($num = 5){
        $list = self::select('id','image_url')
                    ->orderBy('id','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
        return $list;
    }   

    //获取最新小说
    public function getNews($num = 3){
        $list = self::select('novel.id','name','image_url','author_name','tags','desc')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->orderBy('novel.id','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
        return $list;
    }

    //获取首页点击排行
    public function getClicks($num= 3){
        $list = self::select('novel.id','name','image_url','author_name','tags','desc')
                    ->leftJoin('author','novel.a_id','=','author.id')
                    ->orderBy('novel.clicks','desc')
                    ->limit($num)
                    ->get()
                    ->toArray();
        return $list;
    }

}
