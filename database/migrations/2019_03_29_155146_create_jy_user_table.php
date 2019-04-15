<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user', function (Blueprint $table) {
            $table->increments('id');
            $table->char("phone",11)->default("")->comment("手机号");
            $table->string("username",30)->default("")->comment("用户名");
            $table->string("password",32)->default('')->comment("密码");
            $table->string("image_url",150)->default("")->comment("用户头像");
            $table->integer("score")->default(rand(1,100))->comment("用户积分");
            $table->decimal("balance")->comment("用户余额");
            $table->enum("status",[1,2,3])->default(2)->comment("1未激活 2正常 3禁用");
            $table->integer("address_id")->comment("默认地址id");
            $table->timestamps();

            $table->unique("phone");
            $table->index("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_user');
    }
}
