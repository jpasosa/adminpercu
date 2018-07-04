<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpRoziniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_rozini', function (Blueprint $table) {
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('vacio')->nullable();
            $table->string('vacio2')->nullable();
            $table->string('precio')->nullable();
            $table->string('cat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_rozini');
    }
}
