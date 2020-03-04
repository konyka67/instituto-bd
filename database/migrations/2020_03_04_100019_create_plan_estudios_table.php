<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_estudios', function (Blueprint $table) {
            $table->increments('id');      
            $table->integer('cantidad_credito');
            $table->integer('id_materia')->unsigned();
            $table->integer('id_semestre')->unsigned();
            $table->integer('id_carrera')->unsigned();
            $table->integer('id_area')->unsigned();
                    
            $table->timestamps();

            $table->foreign('id_area')
                  ->references('id')
                  ->on('areas');

            $table->foreign('id_materia')
                  ->references('id')
                  ->on('materias');

            $table->foreign('id_semestre')
                  ->references('id')
                  ->on('semestres');

            $table->foreign('id_carrera')
                  ->references('id')
                  ->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_estudios');
    }
}
