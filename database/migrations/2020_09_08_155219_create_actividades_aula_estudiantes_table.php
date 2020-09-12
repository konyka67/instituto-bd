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
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_salon')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->integer('id_programacion_horario')->unsigned()->nullable();
            $table->integer('id_actividad')->unsigned()->nullable();
            $table->integer('id_archivo')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->timestamps();
            $table->foreign('id_actividad')
                ->references('id')
                ->on('actividades_aulas');
            $table->foreign('id_usuario')
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
