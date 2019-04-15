<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyBonusTable extends Migration
{
    /**
     * Run the migrations.
     *  红包表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_bonus', function (Blueprint $table) {
            $table->increments('id');
            $table->string("honus_name",20)->default("")->comment("红包名字");
            $table->decimal("money",10,2)->default(0.00)->comment("红包金额");
            $table->decimal("min_money",10,2)->default(0.00)->comment("满多少钱可以使用");
            $table->tinyinteger("expires")->default(0)->comment("红包可用天数");
            $table->date("send_start_time")->comment("红包发放时间");
            $table->date("send_end_time")->comment("红包结束时间");
            $table->enum("status",[1,2])->default(1)->comment("1可用 2不可用");
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
        Schema::dropIfExists('jy_bonus');
    }
}
