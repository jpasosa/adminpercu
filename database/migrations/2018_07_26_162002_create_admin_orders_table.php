<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        Schema::create('admin_orders', function (Blueprint $table)
        {
            $status = [     'abierta-no-abonada',
                        'abierta-abonada-esperando-instrumentos',
                        'abierta-abonada-instrumentos-stock',
                        'abierta-abonada-en-viaje',
                        'abierta-abonada-viaje-problemas',
                        'cerrada',
                        'ML-esperando-intrumentos',
                        'ML-en-viaje',
                        'ML-con-reclamos',
                        'ML-cerrada'
                    ];
            $table->increments('id');
            $table->unsignedInteger('admin_client_id');
            $table->foreign('admin_client_id')->references('id')->on('admin_clients')->nullable();
            $table->integer('number');
            $table->integer('total_cash_fixed')->nullable();
            $table->integer('total_mp_fixed')->nullable();
            $table->integer('total_ml_fixed')->nullable();
            $table->integer('abonado_cash')->nullable();
            $table->integer('abonado_mp')->nullable();
            $table->integer('abonado_ml')->nullable();
            $table->string('idcobro_mp')->nullable();
            $table->string('idcobro_ml')->nullable();
            $table->date('date_cash')->nullable();
            $table->date('date_mp')->nullable();
            $table->date('date_ml')->nullable();
            $table->date('date_send')->nullable();
            $table->string('empresa_send')->nullable();
            $table->string('codetrack_send')->nullable();
            $table->string('cash_send')->nullable();
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('admin_orders');
    }
}
