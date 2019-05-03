<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Category;
use App\Model\Novel;

class CategoryController extends Controller
{
    //获取分类列表
    public function categoryList()
    {
        $category = new Category();

        $list = $category->getCategory();

        $return = [
            "code" => 2000,
            "msg" => "获取分类列表成功",
            "data" => $list
        ];

        return json_encode($return);
    }

    //根据小说分类获取小说列表
    public function novelList(Request $request)
    {
        $cId = $request->input("c_id",1);

        $novel = new Novel();

        $novelList = $novel->getNoveListByCid($cId);

        $return = [
            "code" => 2000,
            "msg" => "根据小说分类获取小说列表成功",
            "data" => $novelList
        ];
        return json_encode($return);
    }
}
