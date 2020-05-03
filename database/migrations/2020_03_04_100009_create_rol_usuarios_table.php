<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_usuarios', function (Blueprint $table) {
            $table->primary(['id_usuario', 'id_rol']);
            $table->unique(['id_usuario', 'id_rol']);
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_rol')->unsigned();
            $table->timestamps();
            $table->foreign('id_usuario')
                ->references('id')
                ->on('usuarios');
            $table->foreign('id_rol')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_usuarios');
    }
}
