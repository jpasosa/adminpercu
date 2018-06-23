<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpIvsomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_ivsom', function (Blueprint $table) {
            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('peso')->nullable();
            $table->string('medida')->nullable();
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
        Schema::dropIfExists('tmp_ivsom');
    }
}
