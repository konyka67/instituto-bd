<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->integer('id_general')->unsigned()->nullable();
            $table->longText('texto');
            $table->timestamps();
            $table->foreign('id_programa')
            ->references('id')
            ->on('programas');
            $table->foreign('id_general')
            ->references('id')
            ->on('objetivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetivos');
    }
}
