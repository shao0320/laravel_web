<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const
        USE_ABLE     = 1, //可用
        USE_DISABLE  = 2,  //不可用
        END           = true;

    protected $table = "jy_category";
    public $timestamps=false;

    //获取商品分类列表
    public static function  getCategory()
    {
        return self::get()->toArray();
    }

    //根据f_id查询子集分类
    public static function getCategoryByFid($fid=0)
    {
        return self::where("f_id",$fid)->get()->toArray();
    }

    //添加商品分类
    public static function addRecord($data)
    {
        return self::insert($data);
    }

    //删除分类
    public static function delRecord($id)
    {
        return self::where("id",$id)->delete();
    }

    //根据id查询数据
    public static function getFirst($id)
    {
        return self::where("id",$id)->first();
    }

    //修改
    public static function updateData($data,$id)
    {
        return self::where("id",$id)->update($data);
    }
}
