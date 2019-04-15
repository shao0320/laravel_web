<?php

namespace App\Http\Controllers\Admin;

use App\Tools\ToolsAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Region;
class RegionController extends Controller
{
    //列表
    public function list($pid = 0)
    {
        $region = new Region();

        $assign['region_list']  = $this->getLists($region,['p_id'=>$pid]);
//        dd($assign);
        return view("admin.region.list",$assign);
    }

    //添加页面
    public function add()
    {
        $region = new Region();
        $region_list = $this->getLists($region);

        $assign['regionData'] = ToolsAdmin::buildTreeString($region_list,0,0,"p_id");

        return view("admin.region.add",$assign);
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $region = new Region();

        $regionInfo = $this->getDataInfo($region,$params['p_id']);

        $params['level'] = $regionInfo->level+1;

        $res = $this->storeData($region,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加地区失败");
        }

        return redirect("/admin/region/list");
    }

    //删除
    public function del($id)
    {
        $region = new Region();

        $this->delRecord($region,$id);

        return redirect("/admin/region/list");
    }
}
