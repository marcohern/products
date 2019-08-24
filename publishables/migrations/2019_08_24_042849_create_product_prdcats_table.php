<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPrdcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prdcats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id',false,true)->default(0);
            $table->bigInteger('category_id',false,true)->default(0);
            $table->timestamps();

            $table->unique(['product_id','category_id']);
            $table->foreign('product_id')
              ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')
              ->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prdcats');
    }
}
