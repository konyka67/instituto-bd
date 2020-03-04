<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAulaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_aula_estudiantes', function (Blueprint $table) {
            $table->integer('id_actividad')->unsigned(); 
            $table->integer('id_estudiante')->unsigned();          
            $table->string('archivo');       
            $table->timestamps();

            $table->foreign('id_estudiante')
                  ->references('id')
                  ->on('usuarios');
            
            $table->foreign('id_actividad')
                  ->references('id')
                  ->on('actividades_aulas');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_aula_estudiantes');
    }
}
