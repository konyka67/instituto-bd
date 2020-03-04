<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_aulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_plan')->unsigned();
            $table->integer('id_profesor')->unsigned();
            $table->text('titulo');
            $table->text('descripcion');
            $table->integer('ano_gravable');
            $table->boolean('activo');
            $table->timestamps();
            
            $table->foreign('id_plan')
                  ->references('id')
                  ->on('plan_estudios');


            $table->foreign('id_profesor')
                  ->references('id')
                  ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_aulas');
    }
}
