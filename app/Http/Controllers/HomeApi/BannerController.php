<?php

namespace App\Http\Controllers\HomeApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Ad;

class BannerController extends Controller
{
    //前台banner接口
    

    public function list(Request $request)
    {
    	$params = $request->all();

    	dd($params);
    }
}
