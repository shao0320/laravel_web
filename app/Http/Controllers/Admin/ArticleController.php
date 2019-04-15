<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Model\ArticleCategory;
use App\Model\Content;
use Illuminate\Support\Facades\DB;
use Log;

class ArticleController extends Controller
{

    protected $category = null;
    protected $article = null;
    protected $content = null;

    public function __construct()
    {
        $this->category = new ArticleCategory();
        $this->article = new Article();
        $this->content = new Content();
    }
    //文章列表页面
    public function  list()
    {
        $assign['list'] = $this->article->getLists();

        return view("admin.article.article.list",$assign);
    }

    //文章列表添加页面
    public  function  add()
    {
        $cate = new ArticleCategory();

        $assign['info'] = $cate ->getLists();

        return view("admin.article.article.add",$assign);
    }

    //执行文章添加
    public function  doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $content = $params['content'];

        unset($params['content']);

        try{
            DB::beginTransaction(); //开始事务

            $a_id = $this->article->addRecord($params);

            $data = [
                "a_id" => $a_id,
                "content" => $content
            ];

            $this->content->add($data);

            DB::commit();  //提交事务

        }catch(\Exception $e){

            DB::rollback();  //事务回滚

            Log::info("文章添加失败".$e->getMessage());

            return redirect()->back()->with("msg",$e->getMessage());
        }

        return redirect("/admin/article/article/list");
    }

    //删除
    public function del($id)
    {

        $this->content->del($id);

        $this->article->del($id);

        return redirect("/admin/article/article/list");
    }

    //修改
    public function edit($id)
    {

        $cate = new ArticleCategory();

        $assign['cate'] = $cate ->getLists();

        $assign['info'] = $this->article->getFirst($id);

        $assign['content'] =$this->content->getFirst($id);
//            dd($assign);
        return view("admin.article.article.edit",$assign);
    }

    public function  doEdit(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $content = $params['content'];
        $id = $params["id"];
//            dd($params);
        unset($params['content']);
        unset($params['id']);

        try{
            DB::beginTransaction(); //开始事务

            $this->article->updateInfo($params,$id);

            $data = [
                "content" => $content
            ];

            $this->content->updateInfo($data,$id);


            DB::commit();  //提交事务

        }catch(\Exception $e){

            DB::rollback();  //事务回滚

            Log::info("文章修改失败".$e->getMessage());

            return redirect()->back()->with("msg",$e->getMessage());
        }

        return redirect("/admin/article/article/list");
    }
}
