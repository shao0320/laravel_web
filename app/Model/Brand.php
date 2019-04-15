<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    const
        USE_ABLE     = 1, //可用
        USE_DISABLE  = 2,  //不可用
        END           = true;

    protected $table = "jy_brand";

    public $timestamps = false;

    //添加商品品牌
    public static function addRecord($data)
    {
        return self::insert($data);
    }

    //删除商品品牌
    public static function del($id)
    {
        return self::where("id",$id)->delete();
    }


    //获取单条信息
    public static function getFirst($id){
        return self::where("id",$id)->first();
    }
    //修改商品品牌
    public static function updateFirst($data,$id){
        return self::where("id",$id)->update($data);
    }

}
