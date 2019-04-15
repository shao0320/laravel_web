<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\Model\Role;
use App\Tools\ToolsAdmin;
use App\Model\AdminUser;
use App\Model\UserRole;


use Log;

class AdminUsersController extends Controller
{	

	//用户添加页面
    public function create(){

    	$role = new Role();
    	//获取角色列表
    	$assign['roles'] = $role->getRoles();

    	return view("admin.users.add",$assign);
    }

    //执行用户添加
    public function store(Request $request){
    	$params = $request->all();
    	//文件上传
    	$image_url =ToolsAdmin::uploadFile($params['image_url']);

    	try {

    		//开启事务
    		DB::beginTransaction();

    		$adminUser = new AdminUser();
            $userRole = new UserRole();
    		//添加用户
    		$data = [
    			"username" => $params['username'] ?? "",
    			"password" => md5($params['password']) ?? "",
    			"image_url" => $image_url ?? "",
    			"is_super" => $params['is_super'] ?? 1,
    			"status" => $params['status'] ?? 1,
    		];
    		
    	    $adminUser->addRecord($data);

    		$id = $adminUser->getMaxId();

    		//添加用户和角色关联关系
            $data1 = [
                "user_id" => $id->id,
                "role_id" => $params["role_id"] ?? 0
            ];

    		$userRole->addUserRole($data1);

    		//事务提交
    		DB::commit();
    	} catch (\Exception $e) {
    		
    		//事务回滚
    		DB::rollBack();

    	    Log::error("用户添加失败".$e->getMessage());

    		return redirect()->back();

    	}
        return redirect("/admin/user/list");

    }


    //用户列表
    public function list(){

        $list = AdminUser::getList();
        return view("admin.users.list",['list'=>$list]);
    }

    //用户删除
    public function delUser($id){
        try{

            AdminUser::del($id);

            $userRole = new UserRole();
            //删除用户角色关联关系
            $userRole->delByUserId($id);
        }catch(\Exception $e){
            Log::error("删除失败",$e->getMessage());
        }
       return redirect("/admin/user/list");
    }

    // 编辑页面
    public function edit($id)
    {
        $role = new Role();

        //获取角色列表
        $assign['roles'] = $role->getRoles();

        $userRole = new UserRole();

        //获取当前编辑用户的角色id
        $assign['role_id'] = $userRole->getByUserId($id)->role_id ?? 0; 

        //获取用户信息
        $assign['user'] = AdminUser::getUserById($id);

        return view("admin.users.edit",$assign);
    }   

    //用户编辑
    public function doEdit(Request $request)
    {
        $params = $request -> all();

        $image_url = "";

        if(!empty($params['image_url'])){

            $image_url = ToolsAdmin::uploadFile($params['image_url']);
        }

        try {

            //开启事务
            DB::beginTransaction();

            $adminUser = new AdminUser();
            $userRole = new UserRole();
            //修改用户
            $data = [
                "username" => $params['username'] ?? "",
                "is_super" => $params['is_super'] ?? 1,
                "status" => $params['status'] ?? 1,
            ];

            if(!empty($image_url)){
                $data['image_url'] = $image_url;
            }
            
            $adminUser->updateUser($data,$params['id']);

            //修改用户和角色关联关系
            //
            //删除用户角色之前的关联关系
            $userRole->delByUserId($params['id']);
            
            $data1 = [
                "user_id" => $params['id'],
                "role_id" => $params["role_id"] ?? 0
            ];

            $userRole->addUserRole($data1);

            //事务提交
            DB::commit();
        } catch (\Exception $e) {
            
            //事务回滚
            DB::rollBack();

            Log::error("用户修改失败".$e->getMessage());

            return redirect()->back()->with("error_msg",$e->getMessage());

        }

        return redirect("/admin/user/list");
    }
}
