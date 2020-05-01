<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_materias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_grupo')->unsigned();
            $table->integer('id_estudiante')->unsigned();    
            $table->integer('id_plan')->unsigned();      
            $table->timestamps();

            $table->foreign('id_grupo')
                  ->references('id')
                  ->on('grupos');

            $table->foreign('id_estudiante')
                  ->references('id')
                  ->on('usuarios');

            $table->foreign('id_plan')
                  ->references('id')
                  ->on('plan_estudios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiante_materias');
    }
}
