<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table="admin_role";

    //获取所有角色列表
    public function getRoles(){
    	return self::orderBy("id")->get()->toArray();
    }

    //角色删除
    public function delRole($id){
    	return self::where("id",$id)->delete();
    }

    //获取单条信息
    public function getRoleById($id){
    	return self::where("id",$id)->first();	
    }

    //修改角色信息
    public function updateRole($data,$id){
    	return self::where("id",$id)->update($data);
    }

    //添加角色
    public function create($data){
    	return self::insert($data);
    }

}
