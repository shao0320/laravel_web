<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Tools\ToolsAdmin;

class CategoryController extends Controller
{
    //商品分类页面
    public function  list()
    {
        return view("admin.category.list");
    }

    //获取商品列表
    public function getCategory($fid=0)
    {
        $return = [
            "code" => 2000,
            "msg" => "成功",
            "data" => Category::getCategoryByFid($fid)
        ];

        return json_encode($return);
    }

    //商品分类添加页面
    public function add()
    {
        $list = Category::getCategory();

        $assign['list'] = ToolsAdmin::buildTreeString($list,0,0,"f_id");

        return view("admin.category.add",$assign);
    }

    //执行商品分类添加
    public function doAdd(Request $request)
    {
        $params = $request->all();
//            dd($params);
        if(!isset($params['cate_name']) || empty($params['cate_name'])){
            return redirect()->back()->with("msg","商品分类名称不能为空");
        }

        unset($params['_token']);

        $res = Category::addRecord($params);

        if(!$res){
            return redirect()->back()->with("msg","商品分类添加失败");
        }

        return redirect("/admin/category/list");
    }

    //删除商品分类
    public function del($id)
    {
        $return = [
            "code" => 2000,
            "msg" => "删除成功"
        ];

        $res = Category::delRecord($id);

        if(!$res){
            $return = [
                "code" => 4001,
                "msg" => "删除失败"
            ];
        }

        return json_encode($return);
    }

    //商品分类修改页面
    public function edit($id)
    {
        $assign['info'] = Category::getFirst($id);

        $list = Category::getCategory();

        $assign['list'] = ToolsAdmin::buildTreeString($list,0,0,"f_id");
//            dd($assign);
        return view("admin.category.edit",$assign);
    }

    //执行修改商品分类
    public function doEdit(Request $request)
    {
        $params = $request->all();

        $id = $params['id'];

        unset($params['_token']);
        unset($params['id']);
        $res = Category::updateData($params,$id);

        if(!$res){
            return redirect()->back()->with("msg","修改失败");
        }

        return redirect("/admin/category/list");

    }
}
