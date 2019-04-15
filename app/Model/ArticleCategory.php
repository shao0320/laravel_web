<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected  $table = "jy_article_category";
    public $timestamps =false;

    public static function getLists()
    {
        return self::get()->toArray();
    }

    public static function  updateData($data,$id)
    {
        return self::where("id",$id)->update($data);
    }
}
