<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected  $table = "jy_ad";
    public $timestamps = false;

    public function  getLists()
    {
        return self::get()->toArray();
    }

    public static function getInfo()
    {
        return self::select("jy_ad.*","jy_ad_position.position_name")
                        ->leftJoin("jy_ad_position","jy_ad.position_id","=","jy_ad_position.id")
                        ->paginate(2);
    }

    //获取单条信息
    public static function getFirstInfo($id)
    {
        return self::select("jy_ad.*","jy_ad_position.position_name")
            ->leftJoin("jy_ad_position","jy_ad.position_id","=","jy_ad_position.id")
            ->where("jy_ad.id",$id)
            ->first();
    }

    public static function doEdit($data,$id)
    {
        return self::where("id",$id)->update($data);
    }
}
