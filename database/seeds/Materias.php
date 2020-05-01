<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Materias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materias')->insert([
            "id"=>1,
            "nombre"=> "Calculo I",
            "credito"=>2]);
        DB::table('materias')->insert([
            "id"=>2,
            "nombre"=> "Calculo II"
        ,
            "credito"=>2]);
        DB::table('materias')->insert([
            "id"=>3,
            "nombre"=> "Calculo II"
        ,
            "credito"=>2]);

        DB::table('materias')->insert([
            "id"=>4,
            "nombre"=> "Calculo III"
        ,
            "credito"=>2]);

        DB::table('materias')->insert([
            "id"=>5,
            "nombre"=> "Programación I"
        ,
            "credito"=>2]);

        DB::table('materias')->insert([
            "id"=>6,
            "nombre"=> "Programación II"
        ,
            "credito"=>2]);

    }
}
