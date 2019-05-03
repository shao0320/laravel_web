<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsHouns extends Model
{
    
	protected $table="bs_houns";

	public static function getHouns($hounsId){
		 
		$houns = self::where("id",$hounsId)->first();

		return $houns;
	}

	//更新红包信息

	public static function updateHounsInfo($data,$id){
		return self::where("id",$id)->update($data);
	}


	public static function getHounsList(){
		return self::get()->toArray();
	}

	public function addHouns($data){
		return self::insert($data);
	}
}
