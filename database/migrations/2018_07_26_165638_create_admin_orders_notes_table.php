<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOrdersNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_orders_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_order_id')->nullable();
            $table->foreign('admin_order_id')->references('id')->on('admin_orders')->nullable();
            $table->text('note');
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
        Schema::dropIfExists('admin_orders_notes');
    }
}
