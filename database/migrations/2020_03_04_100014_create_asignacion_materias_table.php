<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_materias', function (Blueprint $table) {
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_materia')->unsigned();
            
            $table->timestamps();

            $table->foreign('id_profesor')
                  ->references('id')
                  ->on('usuarios');

            $table->foreign('id_materia')
                  ->references('id')
                  ->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_materias');
    }
}
