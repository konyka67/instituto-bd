<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Planes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planes')->insert([
            "id"=>1,
            "nombre"=> "CUATRIMESTRAL"
        ]);

        DB::table('planes')->insert([
            "id"=>2,
            "nombre"=> "SEMESTRAL"
        ]);

        DB::table('planes')->insert([
            "id"=>3,
            "nombre"=> "ANUAL"
        ]);
    }
}
