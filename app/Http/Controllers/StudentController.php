<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
class StudentController extends Controller
{
    public function index()
    {
    	$student = new Student();
    	$list = $student -> getStudents();
    	// dd($list);
    	return view("student",['list' => $list]);
    }
}
