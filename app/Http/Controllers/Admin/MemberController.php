<?php

namespace App\Http\Controllers\Admin;

use App\Model\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    //列表
    public function list()
    {
        $member  = new Member();

        $assign['list'] = $this->getListsInfo($member);

        return view("admin.member.list",$assign);
    }
}
