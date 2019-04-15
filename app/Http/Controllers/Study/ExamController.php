<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study\Exam;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function add()
    {
        return view("study.exam.add");
    }

    public function store(Request $requets)
    {
        $params = $requets->all();

        $exam = new Exam();

        unset($params['_token']);

        $exam->add($params);

        return redirect("/study/exam/list?user_id=1");

    }

    public function list(Request $request)
    {
        $exam = new Exam();

        $assign['list'] = $exam->getGuess();

        $assign['date'] = time();

        return view("study.exam.list",$assign);
    }

    public function guess(Request $request)
    {
        $params = $request->all();

        $exam = new Exam();

        $assign['list'] = $exam->first($params['id']);
        $assign['team_id'] = $params['id'];
        return view("study.exam.guess",$assign);

    }

    public function doGuess(Request $request)
    {
        $params = $request->all();
            unset($params['_token']);
        $data = DB::table('exam_guess_record')->insert($params);

        return redirect("/study/exam/list?user_id=1");

    }


    public function result(Request $request)
    {
        $params = $request->all();
        $guess = new Exam();

        $assign['list'] = $guess->first($params['id']);

        $assign['result'] = DB::table("exam_guess_record")->where([ "team_id"=>$params['id'],"user_id"=>$params['user_id'] ])->first();

        return view("study.exam.result",$assign);
    }

    //9：45 完成作业
    //我是1806 班
}
