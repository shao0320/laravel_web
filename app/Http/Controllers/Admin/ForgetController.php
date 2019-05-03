<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Model\AdminUser;
use App\Tools\ToolsEmail;

class ForgetController extends Controller
{
    //忘记密码
    

    public function list()
    {

    	return view('/admin/forget/forget');
    }


    public function sendEmail(Request $request)
    {

    	//获取接收的邮箱信息
    	$email = $request->input('email','');
    	//获取接收的用户信息
    	$username = $request->input('username','');

    	$return = [
    			'code'  => 2000,
    			'msg'   => '发送成功'

    		];
    	
    	//检测邮箱或者用户名是否存在
    	
    	$adminUsers  = new AdminUser();

    	$where = [
    		'username' => $username,
    		'email'    => $email
    	];

    	
    	// dd($where);
    	$data1 = $this->getDataInfoByWhere($adminUsers,$where);

    	if(empty($data1)){

    		$return = [
    			'code'  => 4000,
    			'msg'   => '用户名或者邮箱不能为空'

    		];

    		return json_encode($return);
    	}

    	$url = sprintf(env('APP_URL')."/admin/forget/reset"."?username=%s&email=%s&activeCode=%s",$username,$email,ToolsEmail::createActiveCode($username,$email));

    	
    	//发送的是html的邮件
    	//视图的数据
    	$viewData = [

    		'url' => 'admin.forget.email',
    		'assign' => [

    			'username' => $username,
    			'url'      => $url
    		],

    	];

    	//邮件数据
    	$emailData = [
    		'email_address' => $email,
    		'subject'       => "管理后台找回密码"
    	];
    	// dd($emailData);

    	//发送HTML邮件
    	try{
    		$res = ToolsEmail::sendHtmlEmail($viewData,$emailData);

    	}catch(\Exception $e){
    	 
    		$return = [
    			'code'  => 4001,
    			'msg'   => $e->getMessage()

    		];
    	}
   
    	return json_encode($return);

    }


    //重置密码页面
    public function reset(Request $request)
    {

    	$params = $request->all();



    	return view('admin.forget.reset',$params);
    }

    //执行重置密码
    public function save(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);
	

    	if($params['password'] != $params['confirm_password'] ){

    		return redirect()->back()->with('msg','两次密码不一致');
    	}

    	//实例化
    	$adminUsers  = new AdminUser();

    	$where = [
    		'username' => $params['username'],
    		'email'    => $params['email']
    	];

    	//查询要修改的用户id
    	$user = $this->getDataInfoByWhere($adminUsers,$where);


    	$where = [
    		'password' => md5($params['password'])
    	];
    	//修改密码
    	$res = $this->storeData($user,$where);

    	if(!$res){
    		return redirect()->back()->with('msg','修改密码失败');
    	}	

    	return redirect('/admin/login');


    }



}
