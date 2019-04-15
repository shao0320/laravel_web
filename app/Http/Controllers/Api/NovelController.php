<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Novel;
use App\Model\Chapter;

class NovelController extends Controller
{
    //获取小说列表
    public function novelList(Request $request)
    {
        $novel = new Novel();

        $novelList = $novel->novelLists()->toArray();

        $return = [
            "code" => 2000,
            "msg" => "小说书库列表",
            "data" => [
                'page' => $novelList['current_page'],
                'total_page' => $novelList['last_page'],
                'data' => $novelList['data']
            ]
        ];

        return json_encode($return);
    }

    public function readRank(Request $request)
    {
        $num = $request->input("num",6);

        $readRank = new Novel();

        $list = $readRank->ReadRankList();

        $return = [
            "code" => 2000,
            "msg" => "小说阅读榜单",
            "data" => $list
        ];

        return json_encode($return);
    }


    //修改点击次数
    public function clicks($id)
    {
        $novel = new Novel();
        $novel->updateClicks($id);
        $return = [
            "code" => 2000,
            "msg" => "修改点击数成功"
        ];
        return json_encode($return);
    }
}
