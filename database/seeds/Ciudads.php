<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ciudads extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciudads')->insert([
            "id"=>1,
            "nombre"=>"BOGOTÁ",
            "id_departamento"=>1
        ]);
    }
}
