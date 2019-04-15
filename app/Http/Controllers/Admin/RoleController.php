<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Role;
use App\Model\UserRole;
use App\Model\RolePermission;
use App\Model\Permission;

use Illuminate\Support\Facades\DB;
use Log;

class RoleController extends Controller
{
    //角色列表
    public function list(){

    	$roles = new Role();

    	$assign['role_list'] = $roles -> getRoles();

    	return view("admin.roles.list",$assign);
    }


    //删除角色
    public function delRole($id){

    	try {

    		DB::beginTransaction();
    		//删除角色
    		$roles = new Role();
    		$roles->delRole($id);

    		//删除当前的用户角色
    		$userRole = new UserRole();
    		$userRole->delByRoleId($id);

    		//删除当前角色的权限记录
    		$rolePer = new RolePermission();
    		$rolePer->delByRoleId($id);

    		DB::commit();

    	} catch (Exception $e) {

    		DB::rollBack();

    		Log::error("角色删除失败".$e->getMessage());
    	}
    	return redirect("/admin/role/list");
    }


    // 角色添加
    public function create(){
    	return view("admin.roles.create");
    }

     // 执行角色添加
    public function store(Request $request){
    	$params = $request->all();

    	$data = [
    		"rolename" => $params['rolename'] ?? "",
    		"role_desc" => $params['role_desc'] ?? "",
    	];

    	$role = new Role();

    	$res = $role -> create($data);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect("/admin/role/list");
    }

    //角色编辑
    public function edit($id){

    	$role = new Role(); 
    	$assign['role'] = $role -> getRoleById($id);
    	return view("admin.roles.edit",$assign);
    }

    //执行角色编辑
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$data = [
    		"rolename" => $params['rolename'] ?? "",
    		"role_desc" => $params['role_desc'] ?? ""
    	];

    	$roles = new Role();

    	$res = $roles->updateRole($data,$params['id']);

    	if(!$res){

    		return redirect()->back();
    	}

    	return redirect("/admin/role/list");

    }

    //编辑角色权限页面
    public function rolePermission($roleId)
    { 	
    	$role = new Role();

    	//角色信息
    	$assign['roles'] = $role->getRoleById($roleId);

    	//获取所有权限
    	$assign['permissions'] = Permission::getAllPermission();

    	//权限id
    	$assign['p_ids'] = RolePermission::getPermissionById($assign['roles']->id);
    	
    	return view("admin.roles.permission",$assign);
    }

    //执行保存角色权限
    public  function saveRolePermission(Request $request)
    {	
    	$params = $request -> all();
    	
    	try {

    		$roleP = new RolePermission();

    		//删除原有的权限节点
    		$roleP->delByRoleId($params['role_id']);
    	
    		//添加新的权限节点
    		$data = [];

    		foreach ($params['permissions'] as $key => $value) {
    			$data[$key] = [
    				"role_id" => $params['role_id'],
    				"pre_id" => $value,
    			];
    		}

    		$roleP->addRolePermission($data);

    	} catch (\ Exception $e) {
    		
    		Log::error("保存失败".$e->getMessage());

    		return redirect()->back();
    	}

    	return redirect("/admin/role/list");
    }

}
