<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpKingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_king', function (Blueprint $table) {

            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('pulgadas')->nullable();
            $table->string('medidas')->nullable();
            $table->string('precio_lista')->nullable();
            $table->string('precio_cash')->nullable();
            $table->string('precio_mp')->nullable();
            $table->string('precio_ml')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_king');
    }
}
