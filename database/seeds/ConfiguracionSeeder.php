<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuraciones')->insert([
            "key"=>"titulo",
            "value"=>"Institución",
        ]);

        DB::table('configuraciones')->insert([
            "key"=>"logo",
            "value"=>"default_logo.png",
        ]);
    }
}
