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
            $table->integer('manufacturer_id'); // MARCAS, se relaciona con la tabla oc_manufacturer del OC
            $table->string('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->float('list_price', 6, 2);
            $table->float('cash_price', 6, 2);
            $table->float('mp_price', 6, 2);
            $table->float('ml_price', 6, 2);
            $table->integer('oc_product_id')->nullable()->default(0); // relaciona al id del producto en el OC
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
