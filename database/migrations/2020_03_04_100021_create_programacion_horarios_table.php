<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramacionHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacion_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_asig_profe')->unsigned();
            $table -> enum ( 'dia',['Lunes', 'Martes' , 'Miercoles', 'Jueves', 'Viernes' , 'Sabado'] );
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->dateTime('fecha_inicial');
            $table->dateTime('fecha_final');
            $table->timestamps();
            $table->foreign('id_asig_profe')
            ->references('id')
            ->on('asig_profe_asigs')
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
        Schema::dropIfExists('programacion_horarios');
    }
}
