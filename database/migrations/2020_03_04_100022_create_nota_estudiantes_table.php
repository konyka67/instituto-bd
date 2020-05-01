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
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->integer('id_profesor')->unsigned();
            $table->integer('nota_1');
            $table->integer('nota_2');
            $table->integer('nota_definitiva');
            $table->boolean('aplico');
            $table->timestamps();

            $table->foreign('id_estudiante')
                  ->references('id')
                  ->on('usuarios');
            
            $table->foreign('id_plan')
                  ->references('id')
                  ->on('plan_estudios');


            $table->foreign('id_profesor')
                  ->references('id')
                  ->on('usuarios');

            $table->primary(array('id_estudiante','id_plan','id_profesor'));
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
