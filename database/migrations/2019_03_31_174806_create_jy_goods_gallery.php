<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyGoodsGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_goods_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("goods_id")->default(1)->comment("商品id");
            $table->string("image_name",10)->default("")->comment("图片描述");
            $table->string("image_url",120)->default("")->comment("图片地址");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
