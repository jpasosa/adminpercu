<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpGopeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_gope', function (Blueprint $table) {
            $table->string('codigo_nombre')->nullable();
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
        Schema::dropIfExists('tmp_gope');
    }
}
