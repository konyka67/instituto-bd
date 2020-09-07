<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_periodos', function (Blueprint $table) {
            $table->primary(['id_plan','id_programa','periodo']);
            $table->integer('id_plan')->unsigned();
            $table->integer('id_programa')->unsigned();
            $table->tinyInteger('periodo')->unsigned();
            $table->integer('fecha_inicial')->unsigned();
            $table->integer('fecha_final')->unsigned();
            $table->year('ano_gravable')->unsigned();
            $table->timestamps();

            $table->foreign('id_plan')
            ->references('id')
            ->on('planes');

            $table->foreign('id_programa')
            ->references('id')
            ->on('programas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_periodos');
    }
}
