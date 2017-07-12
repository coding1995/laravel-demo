<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户ID');
            $table->integer('goodsid')->comment('商品ID');
            $table->string('goodname')->comment('商品名');
            $table->string('gmages')->comment('商品封面图');
            $table->integer('price')->comment('价格');
            $table->integer('gid')->comment('属性ID');
            $table->string('name')->comment('属性的名称');
            $table->tinyInteger('num')->comment('购买商品数量');
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
        Schema::drop('shop_cars');
    }
}
