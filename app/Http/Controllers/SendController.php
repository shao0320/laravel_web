<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SendController extends Controller
{
    public function show(Request $request){
    	
    	// $User = DB::table("shop_user")->where('id',22)->first();
    	// 	dd($User);
    	// foreach ($User as $key => $value) {
    	// 	echo $value->id;
    	// }

    	return view("show",['message' => "黑飞"]);
    	
    	
    }
}
