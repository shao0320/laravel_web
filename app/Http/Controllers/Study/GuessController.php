<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study\Guess;
use Illuminate\Support\Facades\DB;


class GuessController extends Controller
{
    //添加竞猜页面
    public function add()
    {
        return view("study.guess.add");
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $guess = new Guess();

        $data = [
            "team_a" => $params['team_a'],
            "team_b" => $params['team_b'],
            "end_at" => $params['end_at']
        ];

        $res = $guess->addRecord($data);

        if(!$res){
            return redirect()->back();
        }

        return redirect("/study/guess/list?user_id=1");
    }

    //球队记录
    public function list(Request $request)
    {
        $params = $request -> all();

        $guess = new Guess();

        $assign['info'] = $guess->getGuess();
        $assign['user_id'] = isset($params['user_id']) ?? 1;

        return view("study.guess.list",$assign);
    }

    //竞猜记录
    public function addUserRecord(Request $request)
    {
        $params = $request->all();

        $guess = new Guess();

        $assign['info'] = $guess->getInfo($params['id']);
        $assign['user_id'] = isset($params['user_id']) ?? 1;

        return view("study.guess.guess",$assign);
    }

    //用户竞猜
    public function doGuess(Request $request)
    {
        $params = $request->all();

        unset($params['_token']);

        $data = DB::table("study_guess_user")->where(["user_id"=>$params['user_id'],"team_id" =>$params['team_id']])->first();

        if(empty($data)){
            DB::table("study_guess_user")->insert($params);
        }else{
            DB::table("study_guess_user")->where("id",$data->id)->update($params);
        }
        return redirect("/study/guess/list?user_id=1");
    }

    //竞猜结果
    public function reCord(Request $request)
    {
        $params = $request->all();

        $guess = new Guess();

        $assign['info'] = $guess->getInfo($params['id']);
        $assign['data'] = DB::table("study_guess_user")->where(["user_id"=>$params['user_id'],"team_id" =>$params['id']])->first();
        return view("study.guess.record",$assign);
    }
}
