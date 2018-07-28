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
            $table->integer('total_cash');
            $table->integer('total_mp');
            $table->integer('total_ml');
            $table->integer('total_cash_fixed');
            $table->integer('total_mp_fixed');
            $table->integer('total_ml_fixed');
            $table->integer('abonado_cash');
            $table->integer('abonado_mp');
            $table->integer('abonado_ml');
            $table->string('idcobro_mp');
            $table->string('idcobro_ml');
            $table->date('date_cash');
            $table->date('date_mp');
            $table->date('date_ml');
            $table->date('date_send');
            $table->string('empresa_send');
            $table->string('codetrack_send');
            $table->string('cash_send');
            $table->text('observations');
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
