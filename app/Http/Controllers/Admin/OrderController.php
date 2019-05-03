<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;

class OrderController extends Controller
{
    //订单列表
    

    public function list()
    {

    	//实例化类
    	$order = new Order();

    	$res['order_list'] = $this->getLists($order);

    	// dd($res);

    	return view('/admin/order/list',$res);
    }

    //订单详情
    public function detail($id)
    {

    	$order = new Order();
    	
    	$assign['orderInfo'] = $this->getDataInfo($order,$id);


    	$assign['country'] = Order::getOrderCountry($id);
    	$assign['province'] = Order::getOrderProvince($id);
    	$assign['city'] = Order::getOrderCity($id);
    	$assign['district'] = Order::getOrderDistrict($id);


    	return view('/admin/order/detail',$assign);
    }
}
