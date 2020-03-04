<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->string("id",10)->primary();
            $table->integer('id_carrera')->unsigned();           
            $table->integer('id_estudiante')->unsigned(); 
            $table->integer('id_sede')->unsigned(); 


            $table->timestamp('created_at')->nullable();

            $table->foreign('id_carrera')
                ->references('id')
                ->on('carreras');

            $table->foreign('id_sede')
                ->references('id')
                ->on('sedes');

            $table->foreign('id_estudiante')
                ->references('id')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
}
