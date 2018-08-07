<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProvidersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_providers_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(1);
            $table->unsignedInteger('admin_provider_id')->nullable();
            $table->foreign('admin_provider_id')->references('id')->on('admin_providers')->nullable();
            $table->unsignedInteger('admin_product_id')->nullable();
            $table->foreign('admin_product_id')->references('id')->on('admin_products')->nullable();
            $table->integer('list_price')->default(0);
            $table->float('subt_price')->default(0);
            $table->float('discount_price')->default(0);
            $table->float('total_price')->default(0);
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
        Schema::dropIfExists('admin_providers_products');
    }
}
