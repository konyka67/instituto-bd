<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Localizacions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localizacions')->insert([
            "id"=>1,
            "direccion"=> "DG. 4A #174A24",
            "latitud"=>4.5972098,
            "longitud"=>-74.0887461,
            "id_ciudad"=>1,
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
    }
}
