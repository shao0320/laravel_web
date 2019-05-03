<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected  $table= "jy_user";

    public function getInfo($id)
    {	
    	return self::select("*")
    					->leftJoin("jy_user_info","jy_user.id","=","jy_user_info.user_id")
    					->where("jy_user.id",$id)
    					->first();
    }
}
