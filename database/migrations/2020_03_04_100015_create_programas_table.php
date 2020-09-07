<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_nivel')->unsigned();
            $table->mediumText('mision')->nullable();
            $table->mediumText('vision')->nullable();
            $table->text('justificacion')->nullable();
            $table->text('description')->nullable();
            $table->text('competencias')->nullable();
            $table->text('perfiles')->nullable();
            $table->text('caracteristicas')->nullable();
            $table->text('propositos')->nullable();
            $table->timestamps();
            $table->foreign('id_nivel')
                ->references('id')
                ->on('nivel_academicos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
