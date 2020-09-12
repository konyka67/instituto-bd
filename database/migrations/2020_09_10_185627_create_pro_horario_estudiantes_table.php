<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProHorarioEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //programacion horario estudiantes
        Schema::create('pro_horario_estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_programacion')->unsigned();
            $table->timestamps();
            $table->foreign('id_estudiante')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');
            $table->foreign('id_programacion')
                ->references('id')
                ->on('programacion_horarios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_horario_estudiantes');
    }
}
