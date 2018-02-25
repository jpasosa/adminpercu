<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cp');
            $table->unsignedInteger('admin_province_id')->nullable();
            $table->foreign('admin_province_id')->references('id')->on('admin_provinces');
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
        Schema::dropIfExists('admin_states');
    }
}
