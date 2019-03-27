<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = "students";//指定数据库的表名

    public function getList()
    {
    	$data = self::select()->paginate(2);
    	
    	return $data;
    }
}
