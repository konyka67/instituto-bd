<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForoAulaComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foro_aula_comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_foro')->unsigned();
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_jerarquia_comentario')->unsigned()->nullable();
            $table->text('comentario');
            $table->timestamps();

            $table->foreign('id_usuario')
            ->references('id')
            ->on('usuarios');

            $table->foreign('id_jerarquia_comentario')
            ->references('id')
            ->on('foro_aula_comentarios');

            $table->foreign('id_foro')
            ->references('id')
            ->on('foro_aula_materias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foro_aula_comentarios');
    }
}
