<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_stock_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_product_id')->nullable();
            $table->foreign('admin_product_id')->references('id')->on('admin_products')->nullable();
            $table->integer('quantity');
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('admin_stock_products');
    }
}
