<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_uno');
            $table->string('nombre_dos')->nullable();
            $table->string('apellido_uno')->nullable();
            $table->string('apellido_dos')->nullable();
            $table -> enum ( 'tipo',['ES' , 'AD' ,'PR','SE'] );
            $table->string('correo',90)->nullable();
            $table->string('contrasena')->nullable();
            $table->string('telefono',11)->nullable();
            $table->string('celular',11)->nullable();
            $table->dateTime('cumpleano')->nullable();
            $table->string('foto')->default("default.png");               
            $table -> enum ( 'sex',['F' ,'M','O'])->nullable();
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
        Schema::dropIfExists('usuarios');
    }
}
