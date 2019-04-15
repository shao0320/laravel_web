<?php

namespace App\Http\Controllers\Admin;

use App\Model\GoodsType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsTypeController extends Controller
{
    //列表页面
    public function  list()
    {
        $goodsType = new GoodsType();

        $assign['list'] = $this->getLists($goodsType);

        return view("admin.goodsType.list",$assign);
    }

    //添加页面
    public function add()
    {
        return view("admin.goodsType.add");
    }

    //执行
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $goodsType = new GoodsType();

        $res  = $this->storeData($goodsType,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }

        return redirect("/admin/goods/type/list");
    }

    //修改页面
    public function edit($id)
    {
        $goodsType = new GoodsType();

        $assign['info'] = $this->getDataInfo($goodsType,$id);

        return view("admin.goodsType.edit",$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $goodsType = new GoodsType();

        $res = $this->updateDataInfo($goodsType,$params,$params['id']);

        if(!$res){
            return redirect()->back()->with("msg","修改数据失败");
        }

        return redirect("/admin/goods/type/list");
    }

    //删除
    public function  del($id)
    {
        $goodsType = new GoodsType();

        $this->delRecord($goodsType,$id);

        return redirect("/admin/goods/type/list");
    }
}
