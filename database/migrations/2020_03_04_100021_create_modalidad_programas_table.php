<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModalidadProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modalidad_programas', function (Blueprint $table) {
            $table->primary(['id_modalidad', 'id_programa']);
            $table->integer('id_modalidad')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->timestamps();
            $table->unique(['id_modalidad', 'id_programa']);
            $table->foreign('id_modalidad')
            ->references('id')
            ->on('modalidads');

            $table->foreign('id_programa')
            ->references('id')
            ->on('programas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modalidad_programas');
    }
}
