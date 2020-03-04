<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscuelasProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelas_profesors', function (Blueprint $table) {
            $table->integer('id_profesor')->unsigned();
            $table->integer('id_escuela')->unsigned();
            $table->timestamps();

            $table->foreign('id_profesor')
                ->references('id')
                ->on('usuarios');

            $table->foreign('id_escuela')
                ->references('id')
                ->on('escuelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escuelas_profesors');
    }
}
