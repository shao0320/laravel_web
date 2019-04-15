<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //列表
    public function list()
    {
        $comment = new Comment();

        $assign['lists']= $comment->getLists();
//            dd($assign);
        return view("admin.comment.list",$assign);
    }

    //删除
    public function del($id)
    {
        $comment = new Comment();

        $this->delRecord($comment,$id);

        return redirect("/admin/comment/list");
    }

}
