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
            $table->primary(['id_escuela', 'id_programa','id_usuario']);
            $table->integer('id_programa')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_escuela')->unsigned();
            $table->integer('anio_vigencia_inicial');
            $table->integer('anio_vigencia_final');
            $table->unique(['id_escuela', 'id_programa','id_usuario']);
            $table->timestamps();
            $table->foreign('id_escuela')
                ->references('id')
                ->on('escuelas');
            $table->foreign('id_programa')
                ->references('id')
                ->on('programas');
            $table->foreign('id_usuario')
                ->references('id')
                ->on('usuarios');
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
