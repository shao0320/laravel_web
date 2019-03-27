<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class IndexController extends Controller
{
     /**
     * 签到接口
     * @param  user_id   int   用户名id
     * @return [type]           [description]
     */
    public function index(Request $request){

    	//接收所有的参数
    	$params = $request->Call();
    	// dd($params);die;
    	//接口返回的格式
    	$return = [
    		'code' => 2000,
    		'msg'  => '成功',
    		'data' => []
    	];

    	if(!isset($params['user_id']) || empty($params['user_id'])){

    		$return = [
    			'code' => 4001,
    			'msg'  => '参数不全'
    		];

    		return json($return);
    	}
    	
    	

    }
    
}
