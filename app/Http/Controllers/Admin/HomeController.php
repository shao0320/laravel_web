<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permission;

class HomeController extends Controller
{
   	public function home(){

   		
    	return view('admin.home');
    }
}
