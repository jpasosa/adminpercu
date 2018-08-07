<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_providers', function (Blueprint $table)
        {

            $status = [     'pedido-a-fabrica-brasil',
                        'salio-fabrica-viaje-frontera',
                        'en-frontera',
                        'viajando-caseros',
                        'viajando-catamarca',
                        'para-retirar',
                        'retirados'
                    ];
            $table->increments('id');
            $table->integer('number');
            $table->integer('price_total')->nullable();
            $table->integer('price_discount')->nullable();
            $table->integer('price_fixed')->nullable();
            $table->date('date_aboned')->nullable();
            $table->date('date_arrived')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', $status);
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
        Schema::dropIfExists('admin_providers');
    }
}
