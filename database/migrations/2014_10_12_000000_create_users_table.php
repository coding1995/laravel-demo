<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic', 100)->default('1.jpg')->comment('头像');
            $table->string('username', 32)->comment('用户名')->unique();
            $table->string('password', 100)->comment('密码');
            $table->string('tel',30)->comment('电话');
            $table->string('email', 100)->comment('邮箱');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->string('token',100)->comment('邮箱发送邮件');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
