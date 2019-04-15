<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    protected  $table ="jy_ad_position";

    public static function getLists()
    {
        return self::get()->toArray();
    }

    public function doEdit($data,$id)
    {
        return self::where("id",$id)->update($data);
    }

    public  static  function getInfo($id)
    {
        return self::where("id",$id)->first();
    }

}
