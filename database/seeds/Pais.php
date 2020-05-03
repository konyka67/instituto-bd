<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pais extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pais')->insert([
            "id"=>1,
            "nombre"=>"COLOMBIA",
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
    }
}
