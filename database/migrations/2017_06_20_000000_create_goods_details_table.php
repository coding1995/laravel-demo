<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_details', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('gid')->comment('商品ID');            
            $table->integer('sellnum')->default(0)->comment('销售量');
            $table->integer('clicknum')->default(0)->comment('点击量');
            $table->string('Brand', 100)->comment('商品品牌');
            $table->integer('store')->comment('库存量');
            $table->text('contents')->comment('商品详情描述');
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
        Schema::drop('goods_details');
    }
}
