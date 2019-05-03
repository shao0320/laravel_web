<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = "exam_guess";

    public $timestamps = false;

    public function add($data)
    {
        return self::insert($data);
    }

    public function getGuess()
    {
        return self::get()->toArray();
    }

    public function first($id)
    {
        return self::where("id",$id)->first();
    }
}
