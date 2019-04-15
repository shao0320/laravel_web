<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
class BrandController extends Controller
{
    //商品品牌列表
    public function list()
    {
        return view("admin.brand.list");
    }

    //获取商品品牌数据
    public function getBrandList()
    {
        $list = new Brand();

        $data = $this->getLists($list);

        $return = [
            "code" => 2000,
            "msg" => "成功",
            "data" => $data
        ];

        return json_encode($return);
    }

    //商品品牌添加
    public function  add()
    {
        return view("admin.brand.add");
    }
    //执行商品品牌添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        if(!isset($params['brand_name']) || empty($params['brand_name'])){
            return redirect()->back()->with("msg","商品品牌名称不能为空");
        }

        unset($params['_token']);

        $res = Brand::addRecord($params);
        if(!$res){
            return redirect()->back()->with("msg","添加商品品牌名称失败");
        }
        return redirect("/admin/brand/list");
    }

    //删除商品品牌
    public function del($id)
    {
        $res= Brand::del($id);

        $return = [
            'code' => 2000,
            "msg" =>"删除成功"
        ];

        if(!$res){
            $return = [
                'code' => 4000,
                "msg" =>"删除失败",
            ];
        }
        return json_encode($return);

    }

    //修改页面
    public function edit($id)
    {
        $assign['list'] = Brand::getFirst($id);

        return view("admin.brand.edit",$assign);
    }

    //执行编辑
    public function  doEdit(Request $request)
    {
        $params = $request->all();

        $id = $params['id'];

        unset($params['id']);
        unset($params['_token']);

        $res=Brand::updateFirst($params,$id);

        if(!$res){
            return redirect("/admin/brand/edit/".$params['id']);
        }

        return redirect("/admin/brand/list");
    }

    //修改商品品牌属性
    public function updateStatus(Request $request){

        $params = $request->all();

        $return = [
            "code" => 2000,
            "msg" => "成功"
        ];

        $data = [
            $params['key'] => $params['value']
        ];
        $res = Brand::updateFirst($data,$params['id']);

        if(!$res){
            $return = [
                "code" => 4001,
                "msg" => "修改商品品牌属性失败"
            ];
        }

        return json_encode($return);

    }

}
