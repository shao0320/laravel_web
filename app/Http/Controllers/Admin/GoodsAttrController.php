<?php

namespace App\Http\Controllers\Admin;

use App\Model\GoodsAttr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsType;
class GoodsAttrController extends Controller
{
    //列表页面
    public function list($typeId)
    {
        $where['cate_id'] = $typeId;

        $assign['list'] = GoodsAttr::getLists($where);

        return view("admin.goodsAttr.list",$assign);
    }

    //添加页面
    public function add()
    {
        $goodsType = new GoodsType();

        $assign['list'] = $this->getLists($goodsType);

        return view('admin.goodsAttr.add',$assign);
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        if(!isset($params['attr_name']) || empty($params['attr_name'])){
            return redirect()->back()->with("msg","属性名称不能为空");
        }

        $goodsAttr = new GoodsAttr();

        $res = $this->storeData($goodsAttr,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }

        return redirect("/admin/goods/attr/list/".$params['cate_id']);

    }

    //删除
    public function del($id)
    {
        $goodsAttr = new GoodsAttr();

        $info = $this->getDataInfo($goodsAttr,$id);

        $this->delRecord($goodsAttr,$id);

        return redirect("/admin/goods/attr/list/".$info->cate_id);
    }

    //修改页面
    public function edit($id)
    {
        $goodsAttr = new GoodsAttr();
        $goodsType = new GoodsType();

        $assign['list'] = $this->getLists($goodsType);

        $assign['info'] = $this->getDataInfo($goodsAttr,$id);
//            dd($assign);
        return view("admin.goodsAttr.edit",$assign);
    }


    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request -> all();

        if(!isset($params['attr_name']) || empty($params['attr_name'])){
            return redirect()->back()->with("msg","属性名称不能为空");
        }

        $params = $this->delToken($params);

        $goodsAttr = new GoodsAttr();

        $res = $this->updateDataInfo($goodsAttr,$params,$params['id']);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }
        return redirect("/admin/goods/attr/list/{$params['cate_id']}");
    }
}
