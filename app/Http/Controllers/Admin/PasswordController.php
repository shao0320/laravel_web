<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminUser;

class PasswordController extends Controller
{



    //修改密码
    public function password($id)
    {
    	// dd(md5('zlhyyc'));

        return view('/admin/user/password');
    }

    //执行密码修改
    public function doPassword(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);



    	//查询当前用户的id
    	$user = AdminUser::find($params['user_id']);

    	

    	if($user->password != md5($params['old_password'])){

    		return redirect()->back()->with('msg','原密码错误');
    	}

    	if($params['password'] != $params['confirm_password'] ){

    		return redirect()->back()->with('msg','两次密码不一致');
    	}

    	$where = [
    		'password' => md5($params['password'])
    	];

    	$res = $this->storeData($user,$where);

    	if(!$res){
    		return redirect()->back()->with('msg','修改密码失败');
    	}	

    	return redirect('/admin/home');


    }
}
