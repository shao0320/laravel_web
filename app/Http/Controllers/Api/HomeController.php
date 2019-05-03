<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Novel;

class HomeController extends Controller
{
    //首页banners 图
    public function banners(Request $request)
    {
        $params = $request->input("nums",3);

        $banners = new Novel();

        $banners = $banners->bannersList();

        $return = [
            "code" => 2000,
            "msg" => '获取首页banner图成功',
            "data" => $banners
        ];

        return json_encode($return);
    }

    //首页最新小说
    public function newsNovel(Request $request)
    {
        $params = $request->input("nums",3);

        $newsNovel = new Novel();

        $newsNovel = $newsNovel->newsNovel();

        $return = [
            "code" => 2000,
            "msg" => '获取首页最新小说成功',
            "data" => $newsNovel
        ];

        return json_encode($return);
    }

    //首页点击排行小说
    public function clicksList(Request $request)
    {
        $params = $request->input("nums",3);

        $clicks = new Novel();

        $clicksList = $clicks->clicksList();

        $return = [
            "code" => 2000,
            "msg" => '获取首页点击数量最高小说成功',
            "data" => $clicksList
        ];

        return json_encode($return);
    }

}
