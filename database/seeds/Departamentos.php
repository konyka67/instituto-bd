<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Departamentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            "id"=>1,
            "nombre"=>"BOGOTÁ",
            "id_pais"=>1
        ]);
    }
}
