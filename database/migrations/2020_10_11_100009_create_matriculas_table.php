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
            $table->increments('id');
            $table->integer('id_escuela')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_estudiante')->unsigned();
            $table->integer('id_sede')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->year('ano_gravable')->unsigned();
            $table->boolean('activo')->default(false);
            $table->timestamps();

            $table->foreign('id_escuela')
            ->references('id')
            ->on('escuelas');

            $table->foreign('id_programa')
            ->references('id')
            ->on('programas');

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
