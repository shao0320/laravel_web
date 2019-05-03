<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    //
    protected $table = "admin_prerole";

    //通过角色id删除角色权限记录
    public function delByRoleId($roleId){
    	return self::where("role_id",$roleId)->delete();
    }

    //根据用户角色id 查询权限id
    public static function getPermissionById($roleId){
    	$data =  self::select("pre_id")->where("role_id",$roleId)->get()->toArray();
           
    	$pids = [];

    	foreach ($data as $key => $value) {
    		$pids[] = $value['pre_id'];
    	}
       
    	return $pids;
    }

    //添加新的权限节点
    public function addRolePermission($data){
    	return self::insert($data);
    }
}
