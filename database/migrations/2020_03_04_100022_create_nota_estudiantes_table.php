<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_estudiantes', function (Blueprint $table) {
            $table->primary(['id_profesor', 'id_salon', 'id_estudiante', 'id_programa', 'id_materia', 'id_plan', 'periodo']);
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_salon')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->integer('nota_1');
            $table->integer('nota_2');
            $table->integer('nota_definitiva');
            $table->boolean('aplico');
            $table->timestamps();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_estudiantes');
    }
}
