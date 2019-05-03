<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Study\BsHouns;
use App\Study\BsHounsUser;

use Log;

class BsStudyController extends Controller
{   

    public function houns(){
        return view("Study.houns");
    }

    //获取红包
    public function getHounsLists(){
        $data = BsHouns::getHounsList();
        
        $return = [
            "code" => 2000,
            'msg' => "成功",
            "data" => $data
        ];

        return json_encode($return);
    }

    //添加红包
    public function addHouns(Request $request){
        $params = $request ->param();

        $return = [
            "code" => 2000,
            "msg" => '成功'
        ];

        $data = [
            "total_houns" => $params['total_houns'],
            "total_nums" => $params['total_nums'],
            "left_houns" => $params['total_houns'],
            "left_nums" => $params['total_nums']
        ];

        try {

            BsHouns::addCards($data);

        } catch (\Exception $e) {
            $return = [
                "code" => $e->getCode(),
                "msg" => $e->getMessage()
            ];

            return json_encode($return);
        }

    }

    public function index(Request $request)
    {

    	$params = $request -> all();

    	$return = [
    		"code" => 2000,
    		"msg" => "成功"
    	];

    	if(!isset($params['user_id']) || empty($params['user_id'])){

    		$return = [
    			"code" => 4001,
    			"msg" => "用户未登录"
    		];

    		return json_encode($return);

    	}

    	if(!isset($params['houns_id']) || empty($params['houns_id'])){
    		$return = [
    			"code" => 4002,
    			"msg" => "请选择指定的红包"
    		];

            return json_encode($return);
    	}

        $data = BsHouns::getHouns($params['houns_id']);

        if(empty($data)){
            $return = [
                "code" => 4003,
                "msg" => "红包不存在"
            ];

            return json_encode($return);
        }

        $record = BsHounsUser::getHounsUserId($params['user_id'],$params['houns_id']);

        if($record){
            $return = [
                "code" => 4005,
                "msg" => "该红包已领取"
            ];

            return json_encode($return);
        }

        //红包是否抢完
    	if($data->left_houns <= 0 || $data->left_nums  <= 0){
            $return = [
                "code" => 4004,
                "msg" => "红包已经抢完"
            ];

            return json_encode($return);
    	}

        //判断是否是否是最后一个红包

        if($data->left_nums == 1){

            Log::info("最后一个红包,抢到人的ID".$params['user_id']);
            //用户抢的钱 = 剩余的钱
            $getMoney = $data->left_houns;
            //插入一条记录
            $info = [
                "user_id" => $params['user_id'],
                "houns_id" => $params['houns_id'],
                "houns_nums" => $getMoney,
                "fly" => 1
            ];
            BsHounsUser::insertCard($info);


            //更新红包表数据
            
            $data1 = [
                "left_houns" => 0,
                "left_nums" => 0
            ];

            BsHouns::updateHounsInfo($data1,$params['houns_id']);

            //评选出运气王
            $res = BsHounsUser::getMaxHouns($params['houns_id']);


            BsHounsUser::updateHounsUser(['fly'=>2],$res->id);



        }else{

            $min = 0.01;

            $max = $data->left_houns-($data->left_nums -1)*0.01;

            $getMoney = rand($min*100,$max*100)/100;

            $res = [
                "user_id" =>$params['user_id'],
                "houns_id" => $params['houns_id'],
                "houns_nums" => $getMoney,
                "fly" => 1
            ];

            BsHounsUser::insertCard($res);

            //更新数据
            $data1 = [
                "left_houns" => $data->left_houns - $getMoney,
                "left_nums" => $data->left_nums - 1
            ];

            BsHouns::updateHounsInfo($data1,$params['houns_id']);

        }

        return json_encode($return);

    }
}
