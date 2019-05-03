<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "admin_userrole";

    public $timestamps = false;

    //添加用户角色
    public function addUserRole($data){
    	return self::insert($data);
    }

    //删除用户角色记录
    public function delByUserId($id){
    	return self::where("user_id",$id)->delete();
    }


    //通过用户id获取记录
    public function getByUserId($userId){

        
    	return self::where("user_id",$userId)->first();
    }

     //删除用户角色记录
    public function delByRoleId($roleId){
        return self::where("role_id",$roleId)->delete();
    }

     //通过用户id获取角色id
    public function getRoleIdByUserId($userId){

        
        return self::select("role_id")->where("user_id",$userId)->first();
    }
}
