<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->unsignedInteger('admin_client_id')->nullable();
            $table->foreign('admin_client_id')->references('id')->on('admin_clients')->nullable();
            $table->integer('price_cash')->nullable();
            $table->integer('price_mp')->nullable();
            $table->integer('price_cash_fixed')->nullable();
            $table->integer('price_mp_fixed')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('admin_quotations');
    }
}
