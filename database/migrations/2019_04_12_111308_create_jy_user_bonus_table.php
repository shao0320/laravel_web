<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_bonus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->default(0)->comment("用户id");
            $table->integer("bonus_id")->default(0)->comment("红包id");
            $table->dateTime("start_time")->comment("开始时间");
            $table->dateTime("end_time")->comment("结束时间");
            $table->enum("status",[1,2,3])->default(1)->comment("1未领取2以消费3已过期");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_user_bonus');
    }
}
