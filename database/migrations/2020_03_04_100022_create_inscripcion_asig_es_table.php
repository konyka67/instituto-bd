<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionAsigEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion_asig_es', function (Blueprint $table) {
            $table->primary(['id_estudiante','id_programacion']);
            $table->unique(['id_estudiante','id_programacion']);
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
        Schema::dropIfExists('inscripcion_asig_es');
    }
}
