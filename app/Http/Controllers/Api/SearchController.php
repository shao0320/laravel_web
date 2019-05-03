<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Novel;

class SearchController extends Controller
{
    public function getNovelList(Request $request)
    {
        $name = $request->input("name");

        $novel = new Novel();

        $list = $novel->getNoveListByName($name);

        $total_num = count($list);

        $return = [
            "code" => 2000,
            "msg" => "通过名称查询小说列表成功",
            "data" => [
                'list' => $list,
                'total_num' => $total_num
            ]
        ];

        return json_encode($return);
    }
}
