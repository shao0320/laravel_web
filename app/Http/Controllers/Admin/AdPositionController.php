<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdPosition;
class AdPositionController extends Controller
{
    //列表
    public function  list()
    {

        $assign['list'] = AdPosition::getLists();

        return view("admin.position.list",$assign);
    }

    //添加页面
    public function  add()
    {
        return view("admin.position.add");
    }

    //执行添加
    public function  doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $position = new AdPosition();

        $res = $this->storeData($position,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加失败");
        }
        return redirect("/admin/position/list");

    }

    //删除
    public function  del($id)
    {
        $position = new AdPosition();

        $res = $this->delRecord($position,$id);

        return redirect("/admin/position/list");
    }


    //修改页面
    public function edit($id)
    {
        $position = new AdPosition();

        $assign['info'] = $this->getDataInfo($position,$id);

        return view("admin.position.edit",$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request -> all();

        $id = $params['id'];
        $params = $this->delToken($params);
        unset($params['id']);

        $position = new AdPosition();

        $res = $position->doEdit($params,$id);

        if(!$res){
            return redirect()->back()->with("msg","修改失败");
        }

        return redirect("/admin/position/list");

    }

}
