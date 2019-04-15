<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string("address_name",50)->default("")->comment("名称");
            $table->integer("user_id")->comment("用户id");
            $table->string("consignee")->default("")->comment("收货人名字");
            $table->smallInteger("country")->default(0)->comment("收货人国家");
            $table->smallInteger("province")->default(0)->comment("收货人省份");
            $table->smallInteger("city")->default(0)->comment("收货人城市");
            $table->smallInteger("district")->default(0)->comment("收货人地区");
            $table->string("address",120)->default("")->comment("收货人详细地址");
            $table->string("zipcode",60)->default('')->comment("收货人编码");
            $table->char("mobile",11)->default("")->comment("收货人手机号");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_user_address');
    }
}
