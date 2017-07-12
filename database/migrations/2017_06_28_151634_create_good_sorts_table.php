<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodSortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_sorts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pid')->comment('父类ID');
            $table->string('name')->comment('分类名');
            $table->string('path')->comment('分类路径');
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
        Schema::drop('good_sorts');
    }
}
