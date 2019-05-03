<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\AdminUser;
class AdminController extends Controller
{
    public function login(Request $request){

    	$session = $request -> session();
    	if($session -> has('user')){
    		return redirect("/admin/home");
    	}

    	return view("admin.login");
    }

    

    public function getLogin(Request $request){
    	$params = $request->all();

    	$return = [
    		"code" => 2000,
    		"msg" => "成功"
    	];

    	if(!isset($params['username']) || empty($params['username'])){
    		$return = [
    			"code" => 4001,
    			"msg" => "用户名不能为空"
    		];

    		return json_encode($return);
    	}

    	if(!isset($params['password']) || empty($params['password'])){
    		$return = [
    			"code" => 4002,
    			"msg" => "密码不能为空"
    		];

    		return json_encode($return);
    	}

    	$loginList = AdminUser::loginList($params['username']);

    	if(empty($loginList)){
    		$return = [
    			"code" => 4003,
    			"msg" => "用户名不存在" 
    		];

    		return json_encode($return);
    	}else{

    		$PostPwd = md5($params['password']);
    		$dbPwd = $loginList->password;

    		if($PostPwd !== $dbPwd ){
    			$return = [
    				"code" => 4004,
    				"msg" => "密码错误"
    			];

    			return json_encode($return);
    		}else{

    			//密码正确
    			$session = $request->session();

    			$session -> put("user.user_id",$loginList->id);
    			$session -> put("user.username",$loginList->username);
    			$session -> put("user.image_url",$loginList->image_url);
    			$session -> put("user.is_super",$loginList->is_super);

    			return json_encode($return);
    		}
    	}

    }

    public function logout(Request $request){
    	$request->session()->forget("user");

    	return redirect("/admin/login");
    }
}
