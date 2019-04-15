<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected  $table= "jy_article";

    public function addRecord($data)
    {
        return self::insertGetId($data);
    }


    public function getLists()
    {
        return self::select("jy_article.id","title","publish_at","clicks","status","jy_article_category.cate_name")
                        ->leftJoin("jy_article_category","jy_article.cate_id","=","jy_article_category.id")
                        ->paginate(2);
    }

    public function del($id)
    {
        return self::where("id",$id)->delete();
    }

    public function getFirst($id)
    {
        return self::where("id",$id)->first();
    }


    public function  updateInfo($data,$id)
    {
        return self::where("id",$id)->update($data);
    }
}
