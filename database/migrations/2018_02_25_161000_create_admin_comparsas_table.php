<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminComparsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_comparsas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_comparsa')->nullable();
            $table->string('name_bateria')->nullable();
            $table->unsignedInteger('admin_state_id')->nullable();
            $table->foreign('admin_state_id')->references('id')->on('admin_states');
            $table->string('facebook_page')->nullable();
            $table->integer('members_cant')->nullable();
            $table->boolean('can_publish');
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('admin_comparsas');
    }
}
