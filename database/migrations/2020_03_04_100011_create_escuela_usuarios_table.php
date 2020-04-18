<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscuelaUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuela_usuarios', function (Blueprint $table) {
            $table->primary(['id_usuario', 'id_escuela']);
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_escuela')->unsigned();
            $table->timestamps();
            $table->unique(['id_usuario', 'id_escuela']);
            $table->foreign('id_usuario')
                ->references('id')
                ->on('usuarios');

            $table->foreign('id_escuela')
                ->references('id')
                ->on('escuelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escuela_usuarios');
    }
}
