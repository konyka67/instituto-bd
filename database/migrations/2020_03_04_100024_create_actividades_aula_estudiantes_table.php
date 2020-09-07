<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAulaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_aula_estudiantes', function (Blueprint $table) {
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_salon')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->integer('id_actividad')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->integer('id_archivo')->unsigned();
            $table->foreign('id_actividad')
                ->references('id')
                ->on('actividades_aulas');
            $table->foreign('id_profesor')
                ->references('id')
                ->on('usuarios');
            $table->foreign('id_estudiante')
                ->references('id')
                ->on('usuarios');
            $table->foreign('id_materia')
                ->references('id')
                ->on('materias');
            $table->foreign('id_programa')
                ->references('id')
                ->on('programas');
            $table->foreign('id_plan')
                ->references('id')
                ->on('planes');
            $table->foreign('id_salon')
                ->references('id')
                ->on('salons');
            $table->foreign('id_archivo')
                ->references('id')
                ->on('archivos_bibliotecas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_aula_estudiantes');
    }
}
