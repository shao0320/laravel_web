<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsHounsUser extends Model
{
    //
    protected $table="bs_houns_user";

    public static function insertCard($info){
    	$Crads = self::insert($info);
    	return $Crads;
    }

    public static function getMaxHouns($hounsId){
    	$data = self::select("id")
    				->where("houns_id",$hounsId)
    					->orderBy("houns_nums",'desc')
    						-> first();

    	return $data;
    }

    public static function updateHounsUser($data,$id){
    	return self::where("id",$id)->update($data);
    }

    //
    public static function getHounsUserId($userId,$hounsId){

    	return self::where("user_id" ,$userId)
			    	->where("houns_id",$hounsId)
			    	->first();

    }
}
