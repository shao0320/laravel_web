<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Novel;
use App\Model\Chapter;

class DetailController extends Controller
{
    public function detailList($novelId)
    {
        $novel = new Novel();
        $chapter = new Chapter();

        $list = $novel->DetailByNovelId($novelId);
        $chapter_id = $chapter->getNovelChapter($novelId);
        if(empty($chapter_id)){
            $chapter_id=0;
        }else{
            $chapter_id=$chapter_id->id;
        }
        $return = [
            "code" => 2000,
            "msg" => "获取小说成功",
            "data" => [
                "list" => $list,
                "chapter_id" => $chapter_id
            ]
        ];

        return json_encode($return);
    }
}
