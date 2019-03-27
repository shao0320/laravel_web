<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ks;
class KshbController extends Controller
{
    //红包
    public function index()
    {

    	return view('ks.Index');
    }

    //发红包
    public function addBonus(Request $request)
    {	
    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功' 
    	];

    	$data = [
    		'total_amount' => $params['total_amount'],
    		'left_amount' => $params['total_amount'],
    		'total_num' => $params['total_num'],
    		'left_num' => $params['total_num']
    	];

    	Ks::add($data);

    	return json_encode($return);

    }

    //红包列表
    public  function list(){

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功',
    		'data' => []
    	];
    	$data = Ks::list();
    	$return['data'] =$list;
    	return json_encode($return);
    }
}
