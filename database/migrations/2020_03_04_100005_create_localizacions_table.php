<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('direccion');        
            $table->point('latitud'); 
            $table->point('longitud');   
            $table->integer('id_ciudad')->unsigned();        
            $table->timestamps();
            $table->foreign('id_ciudad')
            ->references('id')
            ->on('ciudads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localizacions');
    }
}
