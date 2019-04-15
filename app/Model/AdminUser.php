<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{	

	protected $table = "admin_users";

	//public $timestamp = true;

    public static function loginList($username){
    	return self::where("username",$username)->where("status",1)->first();
    }

    public static function getUserById($id){
        $userInfo = self::where("id",$id)->first();
        return $userInfo;
    }


    //用户保存
    public function addRecord($data){
    	return self::insert($data);
    }

    //获取最新id
    public function getMaxId(){
    	return self::select('id')->orderBy("id","desc")->first();
        
    }

      //获取用户列表信息
    public static function getList(){
        return self::paginate(1);
    }

    //删除用户
    public static function del($id){
        return self::where("id",$id)->delete();
    }  

    //修改用户
    public function updateUser($data,$id){
        return self::where("id",$id)->update($data);
    }
}
