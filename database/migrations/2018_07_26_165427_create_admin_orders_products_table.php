<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_orders_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(1);
            $table->unsignedInteger('admin_order_id')->nullable();
            $table->foreign('admin_order_id')->references('id')->on('admin_orders')->nullable();
            $table->unsignedInteger('admin_product_id')->nullable();
            $table->foreign('admin_product_id')->references('id')->on('admin_products')->nullable();
            $table->text('clarifications')->nullable();
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
        Schema::dropIfExists('admin_orders_products');
    }
}
