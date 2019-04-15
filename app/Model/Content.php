<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    protected  $table = "jy_article_content";
    public $timestamps = false;


    public function add($data)
    {
       return self::insert($data);
    }

    public function  getFirst($id)
    {
        return self::where("a_id",$id)->first();
    }

    public function updateInfo($data,$id)
    {
        return self::where("a_id",$id)->update($data);
    }

    public function del($id)
    {
        return self::where("a_id",$id)->delete();
    }
}
