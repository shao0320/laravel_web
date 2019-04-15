<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Chapter;
class ChapterController extends Controller
{
    //章节列表
    public function getChapterList($novelId)
    {
        $chapter = new Chapter();

        $list = $chapter->getChapterList($novelId);

        $return = [
            "code" => 2000,
            "msg" => "获取章节成功",
            "data" => $list
        ];

        return json_encode($return);
    }

    //章节内容
    public function chapterContent($id)
    {
       $chapter = new Chapter();

       $content = $chapter->getChapterContent($id);

            //上一章内容
        $prev = $chapter->getPrevChapter($content->novel_id,$content->sort);
            //下一章内容
        $next = $chapter->getNextChapter($content->novel_id,$content->sort);

        if(empty($prev)){
            $prevChapter = 0;
        }else{
            $prevChapter = $prev->id;
        }

        if(empty($next)){
            $nextChapter = 0;
        }else{
            $nextChapter = $next->id;
        }

        $data = [
            "prev_id" => $prevChapter,
            "next_id" => $nextChapter,
            "info" => $content
        ];

        $return = [
            'code' => 2000,
            "msg" => "获取章节内容成功",
            "data" =>$data
        ];

        return json_encode($return);
    }
}
