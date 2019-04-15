<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="jy_comment";

    //列表数据
    public function getLists()
    {
        return self::select("jy_comment.id","jy_goods.goods_name","username","jy_user.image_url","jy_comment.content")
                        ->leftJoin("jy_user","jy_user.id","=","jy_comment.user_id")
                        ->leftJoin("jy_goods","jy_goods.id","=","jy_comment.comment_id")
                        ->get();
    }

}
