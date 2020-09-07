<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionCorteEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_corte_es', function (Blueprint $table) {
            $table->primary(['id_estudiante', 'id_programa', 'id_materia', 'id_plan'],'calificacion_corte_es_id_estudiante_id_programa');
            $table->enum('cortes', ['1', '2', '3', '4']);
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->double('calificacion', 1, 1);
            $table->unique(['id_estudiante', 'id_programa', 'id_materia', 'id_plan'],'calificacion_corte_es_id_estudiante_id_programa');
            $table->timestamps();
            $table->foreign('id_estudiante')
                ->references('id')
                ->on('usuarios');
            $table->foreign('id_programa')
                ->references('id')
                ->on('programas');
            $table->foreign('id_materia')
                ->references('id')
                ->on('materias');
            $table->foreign('id_plan')
                ->references('id')
                ->on('planes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificacion_corte_es');
    }
}
