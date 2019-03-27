<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\DB;

class TestController extends Controller
{
    //
	//抽奖页面
    public function lottery(){

    	return view('test.lottery.index');
    }

    //
    public function doLottery(Request $request){

    	$phone = $request->input('phone');
    	$user_id = $request->input('user_id');

    	$start = date('Y-m-d 10:00:00',time());
    	$end = date('Y-m-d 14:00:00',time());

    	$return = [
    		'cdoe' => 2000,
    		'msg' => '成功'
    	];
    	// return json_encode($return);

    	if(empty($phone)){
    		$return = [
    			'code' => 4001,
    			'msg' => '手机号不能为空'
    		];
    		return json_encode($return);
    	}
    	// dd($phone);
    	//检测用户
    	$user = DB::table('study_lottery_user')->where('phone',$phone)->first();

    	if(empty($user)){
    		$return = [
    			'code' => 4002,
    			'msg' => '用户不存在'
    		];
    		return json_encode($return);
    	}

    	$record = DB::table('study_lottery_record')->where('user_id',$user_id)->where('created_at',date('Y-m-d'));
    	// dd($record);
    	//抽奖次数
    	if($record >= 3){
    		$return = [
    			'code' => 4003,
    			'msg' => '今日抽奖次数已经用完'
    		];
    		return json_encode($return);
    	}

    	//判断活动时间
    	if(time() > strtotime($end) || time() < strtotime($start)){
    		$return = [
    			'code' => 4004,
    			'msg' => '请在活动期间内抽奖'
    		];
    		return json_encode($return);
    	}

    	$lottery = DB::table('study_lottery')->get()->toArray();

    	$lotterys = $precents = [];

    	foreach ($lottery as $key => $value) {
    		//奖品
    		$lotterys[$value->id] = [
    			'lottery_name' => $value->lottery_name
    		];
    		//抽奖概率
    		$precents[$value->id] = $value->precent;
    	}
    	// dd($lotterys,$precents);

    	//概率求和
    	$preSum = array_sum($precents);
    	// dd($preSum);

    	//中奖概率求和
    	$result = '';

    	//计算中奖
    	foreach ($precents as $k => $v) {
    		//随机概率
    		$preCurrent = mt_rand(1, $preSum);
    		//如果设置的中奖概率小于随机值，中奖了
    		if($v > $preCurrent){
    			$result = $k;
    			break;
    		}else{
    			$preSum = $preSum - $v;
    		}
    	}
    	
    	$data = [
    		'user_id' => $user_id,
    		'lottery_id' => $result,
    		'created_at' => date('Y-m-d')
    	];
    	DB::table('study_lottery_record')->insert($data);
    	$return['msg'] = $lotterys[$result]['lottery_name'];
    	return json_encode($return);
    }
}
