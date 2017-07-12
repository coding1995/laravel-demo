<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('uid')->comment('用户ID');
            $table->string('num_id')->comment('订单号');
            $table->string('buy')->comment('订单总金额');
            $table->string('postcodes')->comment('邮编');
            $table->string('address')->comment('发货地址');
            $table->string('tel')->comment('电话');
            $table->tinyInteger('num')->comment('购买商品数量');
            $table->tinyInteger('state')->default(1)->comment('订单状态');
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
        Schema::drop('orders');
    }
}
