<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
class StudentController extends Controller
{
    //
    public function index(){
    		
    		$data = new Student();

    		$data = $data->getList();
    		
    		// dd($data);die;


    		return view('kp',['data'=>$data]);
    }
}
