<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_lineas', function (Blueprint $table) {

            $table->primary(['id_materia_origen', 'id_materia']);
            $table->integer('id_materia_origen')->unsigned();
            $table->integer('id_materia')->unsigned()->nullable();
            $table->timestamps();
            $table->unique(['id_materia_origen', 'id_materia']);

            $table->foreign('id_materia')
                ->references('id')
                ->on('materias');

            $table->foreign('id_materia_origen')
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
        Schema::dropIfExists('materias_lineas');
    }
}
