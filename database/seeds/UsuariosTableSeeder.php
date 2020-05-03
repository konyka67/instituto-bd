<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre'=>'juan camilo rodriguez diaz',
            'nombre_uno' =>'juan',
            'nombre_dos' => 'camilo',
            'apellido_uno' => 'rodriguez',
            'apellido_dos' => 'diaz',
            'email' => 'admin@gmail.com',
            'tipo'=>'AD',
            'cedula'=>'1022353924',
            'sex'=>'M',
            'id_localizacion'=>1,
            'celular'=>3115907753,
            'password' => bcrypt('123'),
             "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('usuarios')->insert([
            'nombre'=>'constanza becerra tamayo',
            'nombre_uno' =>'constanza',
            'nombre_dos' => '',
            'apellido_uno' => 'becerra',
            'apellido_dos' => 'tamayo',
            'email' => 'ing.constanza1@gmail.com',
            'tipo'=>'PR',
            'cedula'=>'1052401466',
            'sex'=>'F',
            'celular'=>3132657947,
            'password' => bcrypt('123'),
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('usuarios')->insert([
            'nombre'=>'carlos humberto rodriguez parra',
            'nombre_uno' =>'carlos',
            'nombre_dos' => 'humberto',
            'apellido_uno' => 'rodriguez',
            'apellido_dos' => 'parra',
            'email' => 'carlos@gmail.com',
            'tipo'=>'PR',
            'cedula'=>'1052401467',
            'sex'=>'M',
            'celular'=>3115208693,
            'password' => bcrypt('123'),
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);


    }
}
