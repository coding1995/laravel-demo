<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32)->comment('用户名')->unique();
            $table->tinyInteger('is_admin')->default(0)->comment('角色');
            $table->tinyInteger('sex')->default(1)->comment('性别');
            $table->string('password', 100)->comment('密码');
            $table->tinyInteger('grade')->default(1)->comment('状态');
            $table->string('pic', 100)->default('1.jpg')->comment('头像');
            $table->string('tel',30)->comment('电话');
            $table->string('email', 100)->comment('邮箱');
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
        Schema::drop('admins');
    }
}
