<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleCategory;

class ArticleCategoryController extends Controller
{
    //文章分类列表
    public function list()
    {
        $assign['list'] = ArticleCategory::getLists();
//            dd($assign);
        return view("admin.article.category.list",$assign);
    }

    //文章分类添加
    public function add()
    {
        return view("admin.article.category.add");
    }

    //执行文章分类添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $articleCategory = new ArticleCategory();

        $res = $this->storeData($articleCategory,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加文章分类失败");
        }

        return redirect("/admin/article/category/list");
    }

    //文章分类删除
    public function del($id)
    {
        $articleCategory = new ArticleCategory();

        $res = $this->delRecord($articleCategory,$id);

        return redirect("/admin/article/category/list");
    }

    //修改页面
    public function edit($id)
    {
        $articleCategory = new ArticleCategory();

        $assign['list'] = $this->getDataInfo($articleCategory,$id);
//        dd($assign);
        return view("admin.article.category.edit",$assign);
    }

    //执行修改
    public function  doEdit(Request $request)
    {
        $params = $request -> all();

        $id = $params['id'];

        unset($params['id']);

        $params = $this->delToken($params);

       $res = ArticleCategory::updateData($params,$id);


        if(!$res){
            return redirect()->back()->with("msg","修改失败");
        }

        return redirect("/admin/article/category/list");
    }

}
