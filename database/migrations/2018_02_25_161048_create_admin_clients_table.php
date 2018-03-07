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
            $table->string('user_ml');
            $table->string('email');
            $table->string('dni');
            $table->string('phone');
            $table->string('face');
            $table->boolean('friends');
            $table->unsignedInteger('admin_state_residence_id')->nullable();
            $table->foreign('admin_state_residence_id')->references('id')->on('admin_states');
            $table->unsignedInteger('admin_state_shipping_id')->nullable();
            $table->foreign('admin_state_shipping_id')->references('id')->on('admin_states');
            $table->unsignedInteger('admin_comparsas_id')->nullable();
            $table->foreign('admin_comparsas_id')->references('id')->on('admin_comparsas');
            $table->mediumText('observations');
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
