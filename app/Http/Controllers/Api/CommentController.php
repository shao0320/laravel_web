<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;

class CommentController extends Controller
{
    //评论添加
    public function add(Request $request)
    {
        $params = $request->all();

        $return = [
            "code" => 2000,
            "msg" => "成功"
        ];

        $data = [
            "novel_id" => $params['novel_id'],
            "user_id" => isset($params['user_id']) ??  1,
            "content" => $params['content'],
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s",time())
        ];

        $comment = new Comment();

        $add = $comment->addRecord($data);

        if(!$add){
            $return = [
                "code" => 4001,
                "msg" => "添加失败",
            ];
        }

        return json_encode($return);

    }

    //评论列表
    public function list($novelId)
    {
        $comment = new Comment();

        $data = $comment -> getCommentList($novelId);

        $return = [
            "code" => 2000,
            "msg" => "获取评论列表成功",
            "data" => $data
        ];

        return json_encode($return);
    }

    //评论删除
    public function del($id)
    {
        $return = [
            "code" => 2000,
            'msg' => "删除成功"
        ];

        $comment = new Comment();

        $del = $comment -> del($id);

        if(!$del){
            $return = [
                "code" => 4002,
                'msg' => "删除失败"
            ];
        }

        return json_encode($return);
    }
}
