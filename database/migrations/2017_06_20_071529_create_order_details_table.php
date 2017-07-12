<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('uid')->comment('用户ID');
            $table->string('oid')->comment('订单ID');
            $table->tinyInteger('gid')->comment('商品ID');
            $table->tinyInteger('num')->comment('商品数量');
            $table->string('price')->comment('商品单价');
            $table->string('state')->default(1)->comment('订单评价状态');
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
        Schema::drop('order_details');
    }
}
