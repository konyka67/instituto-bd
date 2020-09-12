<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosBibliotecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_bibliotecas', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('id_salon')->unsigned();
            $table->integer('id_programacion_horario')->unsigned()->nullable();
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->string('nombre');
            $table->string('extension');
            $table -> enum ( 'tipo',['CASA' ,'CLASE','ENTREGABLE']);
            $table->integer('totalPaginas')->nullable();
            $table->boolean('todos')->nullable();
            $table->timestamps();

            $table->foreign('id_salon')
            ->references('id')
            ->on('salons');

            $table->foreign('id_programacion_horario')
            ->references('id')
            ->on('programacion_horarios');

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
        Schema::dropIfExists('archivos_bibliotecas');
    }
}
