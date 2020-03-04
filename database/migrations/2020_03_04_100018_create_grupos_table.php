<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_escuela')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_profesor')->unsigned();
            $table->integer('numero');
            $table->timestamps();
            
            $table->foreign('id_materia')
                   ->references('id')
                   ->on('materias');

            
            $table->foreign('id_escuela')
                  ->references('id')
                  ->on('escuelas');

            $table->foreign('id_profesor')
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
        Schema::dropIfExists('grupos');
    }
}
