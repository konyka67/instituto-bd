<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsigEstudianteAsigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asig_estudiante_asigs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_area')->unsigned()->nullable();
            $table->integer('id_plan')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->year('ano_gravable')->unsigned();
            $table->boolean('activo')->default(false);
            $table->integer('id_profesor')->unsigned()->nullable();
            $table->integer('id_salon')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_area')
                ->references('id')
                ->on('areas');
            $table->foreign('id_materia')
                ->references('id')
                ->on('materias');
            $table->foreign('id_programa')
                ->references('id')
                ->on('programas');
            $table->foreign('id_plan')
                ->references('id')
                ->on('planes');
            $table->foreign('id_estudiante')
                ->references('id')
                ->on('usuarios');

                $table->foreign('id_profesor')
                ->references('id')
                ->on('usuarios');

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
        Schema::dropIfExists('asig_estudiante_asigs');
    }
}
