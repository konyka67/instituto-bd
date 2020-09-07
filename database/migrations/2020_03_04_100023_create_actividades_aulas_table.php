<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_aulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_salon')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->text('titulo');
            $table->text('descripcion');
            $table->integer('ano_gravable');
            $table->boolean('activo');
            $table->timestamps();
            $table->foreign('id_profesor')
                ->references('id')
                ->on('usuarios');
            $table->foreign('id_materia')
                ->references('id')
                ->on('materias');
            $table->foreign('id_programa')
                ->references('id')
                ->on('programas');
            $table->foreign('id_plan')
                ->references('id')
                ->on('planes');
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
        Schema::dropIfExists('actividades_aulas');
    }
}
