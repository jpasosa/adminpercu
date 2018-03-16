<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('user_ml')->nullable();
            $table->string('user_whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('dni');
            $table->string('phone');
            $table->string('face')->nullable();
            $table->boolean('friends');
            $table->enum('marketing', ['Por Facebook Juan Pablo Sosa', 'Por facebook.com/comparsas.percu', 'Por la Web www.percu.com.ar',
                                        'Por Busqueda Google', 'Por un Amigo', 'Ya nos conociamos', 'Por una promo que hicimos', 'Por volantes', 'Otros'])
                                        ->default('Otros');
            $table->boolean('ya_nos_compro')->default(false); // el cliente ya nos hizo una compra ?
            $table->unsignedInteger('admin_state_residence_id')->nullable();
            $table->foreign('admin_state_residence_id')->references('id')->on('admin_states');
            $table->unsignedInteger('admin_state_shipping_id')->nullable();
            $table->foreign('admin_state_shipping_id')->references('id')->on('admin_states');
            $table->unsignedInteger('admin_comparsas_id')->nullable();
            $table->foreign('admin_comparsas_id')->references('id')->on('admin_comparsas')->nullable();
            $table->mediumText('observations')->nullable();
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
        Schema::dropIfExists('admin_clients');
    }
}
