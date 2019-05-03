<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyGoodsAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_goods_attr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cate_id")->default(0)->comment('分类id');
            $table->string("attr_name")->default("")->comment("属性名称");
            $table->enum("input_type",[1,2])->comment("1手动输入 2单选");
            $table->string("attr_value")->default("")->comment("属性值");
            $table->enum("status",[1,2])->default(1)->comment("1正常 2禁用");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_goods_attr');
    }
}
