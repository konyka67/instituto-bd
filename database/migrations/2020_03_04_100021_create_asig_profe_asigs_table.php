<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsigProfeAsigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //tabla asignacion profesor asignaturas
        Schema::create('asig_profe_asigs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->integer('id_profesor')->unsigned()->nullable();
            $table->integer('id_plan')->unsigned();
            $table->integer('id_salon')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('cupos')->unsigned();
            $table->integer('grupo')->unsigned();
            $table->timestamps();
            $table->foreign('id_profesor')
            ->references('id')
            ->on('usuarios')
            ->onDelete('cascade');
            $table->foreign('id_salon')
            ->references('id')
            ->on('salons');
            $table->foreign('id_materia')
            ->references('id')
            ->on('materias');
            $table->foreign('id_programa')
            ->references('id')
            ->on('programas');
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
        Schema::dropIfExists('asig_profe_asigs');
    }
}
