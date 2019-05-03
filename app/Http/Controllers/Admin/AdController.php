<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Ad;
use App\Model\AdPosition;
use App\Tools\ToolsAdmin;
use Excel;
use App\Tools\ToolsOss;
class AdController extends Controller
{
    //列表页面
    public function list()
    {
        $ad = new Ad();

        $assign['list'] = $ad->getInfo();

        return view("admin.ad.list",$assign);
    }

    //广告添加页面
    public function add()
    {
        $assign['list'] = AdPosition::getLists();

        return view("admin.ad.add",$assign);
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        if(!isset($params['image_url']) ||  empty($params['image_url'])){
            return redirect()->back()->with("msg","请先上传图片");
        }

        $files = $params['image_url'];

        $params['image_url']=ToolsAdmin::uploadFile($files,false);

//        $oss = new ToolsOss();
//
//        $params['image_url'] = $oss->putFile($files);

        $params = $this->delToken($params);
        // dd($params);

        $ad = new Ad();

        $res = $this->storeData($ad,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加失败");
        }

        return redirect("/admin/ad/list");

    }

    //删除
    public function del($id)
    {
        $ad = new Ad();

        $this->delRecord($ad,$id);

        return redirect("/admin/ad/list");
    }

    //修改页面
    public function edit($id)
    {
        $adPosition = new AdPosition();

        $assign['position'] = $adPosition->getLists();

        $assign['info'] = Ad::getFirstInfo($id);

        return view("admin.ad.edit",$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();

        $info = Ad::getFirstInfo($params['id']);

        if(!isset($params['image_url']) ||  empty($params['image_url'])){
            $params['image_url'] = $info->image_url;
        }else{
            $params['image_url'] = ToolsAdmin::uploadFile($params['image_url'],false);
        }

        $params = $this->delToken($params);

        $id = $params['id'];

        unset($params['id']);

        $res = Ad::doEdit($params,$id);

        if(!$res){
            return reidrect()->back()->with("msg","修改失败");
        }

        return redirect("/admin/ad/list");
    }

}
