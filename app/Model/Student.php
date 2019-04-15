<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "shop_user";

    public $timestamps = false;

    public function getStudents(){

    	$students = self::paginate(2);

    	return $students; 

    }

    
}
