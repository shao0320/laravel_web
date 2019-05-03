<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permission;
class PermissionController extends Controller
{
    public function list(){
    	return view("admin.permission.list");
    }

    public function getPermissionList($fid=0){

    	$return = [
    		"code" => 2000,
    		"msg" => "获取权限列表成功",
    		"data" => []
    	];
    	//获取权限列表
    	$list = Permission::getListByFid($fid);

    	$return['data'] = $list;

    	return json_encode($return);
    }

    //权限添加方法
    public function create(){
        $list = Permission::getListByFid();
    	return view("admin.permission.create",['permissions' => $list]);
    }

    //执行权限添加
    public function doCreate(Request $request){

        $params = $request ->all();

        $data = [
            "fid" => $params['fid'],
            "name" => $params['name'],
            "url" => $params['url'],
            "is_menu" => $params['is_menu'],
            "sort" => $params['sort'],
        ];

        $res = Permission::addRecord($data);

        if($res){
            return redirect("/admin/permission/list");
        }else{
            return redirect()->back();
        }
    }
    //删除
    public function del($id){
        $res = Permission::delRecord($id);

        if($res){

             $return = [
                "code" => 2000,
                "msg" => "删除成功"
            ];

        }else{

             $return = [
                "code" => 4000,
                "msg" => "删除失败"
            ];
        }
        return json_encode($return);
    }
}
