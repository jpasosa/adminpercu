<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->integer('oc_manufacturer_id'); // MARCAS, se relaciona con la tabla oc_manufacturer del OC
            $table->integer('oc_category_id')->nullable(); // MARCAS, se relaciona con la tabla oc_manufacturer del OC
            $table->string('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->integer('list_price');
            $table->integer('cash_price');
            $table->integer('mp_price');
            $table->integer('ml_price');
            $table->integer('oc_product_id')->nullable()->default(0); // relaciona al id del producto en el OC
            $table->integer('cash_gain');
            $table->integer('mp_gain');
            $table->integer('ml_gain');
            $table->boolean('popular')->nullable()->default(false); // relaciona al id del producto en el OC
            $table->text('ml_description')->nullable();
            $table->text('oc_description')->nullable();
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
        Schema::dropIfExists('admin_products');
    }
}
