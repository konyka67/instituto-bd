<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulaForoEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_foro_estudiantes', function (Blueprint $table) {
            $table->integer('id_foro')->unsigned(); 
            $table->integer('id_estudiante')->unsigned();          
            $table->text('descripcion');     
            $table->timestamps();

            $table->foreign('id_estudiante')
                  ->references('id')
                  ->on('usuarios');
            
            $table->foreign('id_foro')
                  ->references('id')
                  ->on('aula_foros');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aula_foro_estudiantes');
    }
}
