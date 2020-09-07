<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultimediaNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia_noticias', function (Blueprint $table) {

            $table->primary(['id_noticia', 'id_multimedia']);
            $table->integer('id_noticia')->unsigned();
            $table->integer('id_multimedia')->unsigned();
            $table->timestamps();
            $table->unique(['id_multimedia', 'id_noticia']);

            $table->foreign('id_noticia')
            ->references('id')
            ->on('noticias');

            $table->foreign('id_multimedia')
            ->references('id')
            ->on('multimedias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multimedia_noticias');
    }
}
