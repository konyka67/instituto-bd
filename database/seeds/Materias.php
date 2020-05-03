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
            "id" => 1,
            "nombre" => "Calculo I",
            "credito" => 2,
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
        DB::table('materias')->insert([
            "id" => 2,
            "nombre" => "Calculo II",
            "credito" => 2,
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);
    }
}
