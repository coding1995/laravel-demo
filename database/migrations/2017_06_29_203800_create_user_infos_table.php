<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //用户登录错误信息表
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户');
            $table->integer('ipaddr')->comment('地址');
            $table->timestamp('logintime')->comment('登录时间');
            $table->tinyInteger('pass_wrong_time_status')->comment('错误状态0为正确1为错误');
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
        Schema::drop('user_infos');
    }
}
