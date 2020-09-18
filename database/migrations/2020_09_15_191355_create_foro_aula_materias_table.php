<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForoAulaMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foro_aula_materias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_asig_profe_asigs')->unsigned();
            $table->string('titulo');
            $table->longText('descripcion');
            $table->timestamps();
            $table->foreign('id_profesor')
            ->references('id')
            ->on('usuarios');
            $table->foreign('id_asig_profe_asigs')
            ->references('id')
            ->on('asig_profe_asigs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foro_aula_materias');
    }
}
