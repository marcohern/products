<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
  public function up()
  {
    Schema::create('product_categories', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name',128);
      $table->string('slug',128)->unique();
      $table->integer('parent_id')->nullable();
      $table->string('type',32)->default('category');
      $table->integer('ord')->default(0);
      $table->integer('lvl')->default(0);
      $table->text('description');

      $table->integer('hits')->default(0);
      $table->integer('clicks')->default(0);
      $table->integer('sales_count')->default(0);
      $table->decimal('sales_value',18,2)->default(0);

      $table->index('parent_id');
      $table->index('ord');
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
    Schema::dropIfExists('product_categories');
  }
}
