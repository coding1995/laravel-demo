<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('typeid')->comment('分类ID');
            $table->string('goodname')->comment('商品名');
            $table->string('gmages')->comment('商品封面图');
            $table->string('introduction')->comment('商品简介');
            $table->tinyInteger('state')->default(0)->comment('状态');
            $table->integer('price')->comment('价格');
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
        Schema::drop('goods');
    }
}




