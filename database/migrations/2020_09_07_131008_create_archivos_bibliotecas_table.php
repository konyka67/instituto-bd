<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosBibliotecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_bibliotecas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('extension');
            $table -> enum ( 'tipo',['CASA' ,'CLASE','ENTREGABLE'])->nullable();
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
        Schema::dropIfExists('archivos_bibliotecas');
    }
}
