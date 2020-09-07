<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Doctorado, Maestria, especializacion, postdoctorado,profesional universitario, tecnologico y tecnico
        Schema::create('nivel_academicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table -> enum ( 'tipo',['DO' ,'MA' ,'ES','POS','PRO','TECNO','TECNI','BACHI'] );
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
        Schema::dropIfExists('nivel_academicos');
    }
}
