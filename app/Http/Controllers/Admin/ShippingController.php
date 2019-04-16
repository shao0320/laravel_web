<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shipping;
class ShippingController extends Controller
{
    //列表
    public function list()
    {
        $shipping = new Shipping();

        $assign['list'] = $this->getPageList($shipping);

        return view("admin.shipping.list",$assign);
    }

    //添加
    public function add()
    {
        return view("admin.shipping.add");
    }

    //执行添加
    public function  doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $shipping = new Shipping();

        $res = $this->storeData($shipping,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }

        return redirect("/admin/shipping/list");
    }

    //删除
    public function del($id)
    {
        $shiping = new Shipping();

        $this->delRecord($shiping,$id);

        return redirect("/admin/shipping/list");
    }
}
