<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePptIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppt_integrantes', function (Blueprint $table) {
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_archivo')->unsigned();

            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios');

            $table->foreign('id_archivo')
            ->references('id')
            ->on('archivos_bibliotecas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppt_integrantes');
    }
}
