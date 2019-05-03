<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bonus;
use App\Model\UserBonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Member;

class BonusController extends Controller
{
    //列表
    public function list()
    {
        $bonus = new Bonus();

        $assign['bonus_list'] = $this->getLists($bonus);

        return view("admin.bonus.list",$assign);
    }

    //添加
    public function add()
    {
        return view("admin.bonus.add");
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $bonus = new Bonus();

        $res = $this->storeData($bonus,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }

        return redirect("/admin/bonus/list");
    }

    //修改
    public function edit($id)
    {
        $bonus = new  Bonus();

        $assign['bonusInfo'] = $this->getDataInfo($bonus,$id);

        return view("admin.bonus.edit",$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $bonus = new bonus();

        $res = $this->updateDataInfo($bonus,$params,$params['id']);

        if(!$res){
            return redirect()->back()->with('msg',"修改红包数据失败");
        }

        return redirect("/admin/bonus/list");
    }

    //删除
    public function del($id)
    {
        $bonus = new Bonus();

        $this->delRecord($bonus,$id);

        return redirect("/admin/bonus/list");
    }


    //发放红包
    public function sendAdd($id)
    {
        $bonus  = new Bonus();

        $assign['bonus_info'] = $this->getDataInfo($bonus,$id);

        return view("admin.bonus.send",$assign);
    }

     //执行发送红包
    public function sendStore(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);
        // dd($params);
        //查询用户的信息
        $user = new Member();

        $userInfo  = $this->getDataInfo($user, $params['phone'],'phone');

        if(empty($userInfo)){
            return redirect()->back()->with('msg','用户不存在,红包发送失败');
        }
    
        //用户红包的数据
        $userBonusData = [
            'user_id' => $userInfo->id,
            'bonus_id' => $params['bonus_id'],
            'start_time' => date("Y-m-d H:i:s"),
            'end_time'   => date('Y-m-d H:i:s',strtotime("+ ".$params['expires']." days")),
        ];

        $userBonus = new UserBonus();

        $res = $this->storeData($userBonus, $userBonusData);

        if(!$res){
            return redirect()->back()->with('msg','红包发送失败');
        }
        return redirect('/admin/bonus/list');
    }

    //红包领取记录
    public function userBonusList()
    {
        $userBonus = new UserBonus();

        $assign['user_bonus'] = $userBonus->getSendRecord();
            // dd($assign);
        return view('admin.bonus.userBonus',$assign);
    }
}
