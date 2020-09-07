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
            'nombre'=>'Carol Tatiana Rodriguez Becerra',
            'nombre_uno' =>'Carol',
            'nombre_dos' => 'Tatiana',
            'apellido_uno' => 'Rodriguez',
            'apellido_dos' => 'Becerra',
            'email' => 'tatiana@gmail.com',
            'tipo'=>'PR',
            'cedula'=>'1282353929',
            'sex'=>'F',
            'id_localizacion'=>1,
            'celular'=>3115907753,
            // 'id_rol'=> 2 ,
            'password' => bcrypt('123'),
             "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('usuarios')->insert([
            'nombre'=>'Candida Rosa Tamayo',
            'nombre_uno' =>'candida',
            'nombre_dos' => 'rosa',
            'apellido_uno' => 'tamayo',
            'apellido_dos' => '',
            'email' => 'rosa@gmail.com',
            'tipo'=>'ES',
            'cedula'=>'1022353929',
            'sex'=>'F',
            'id_localizacion'=>1,
            'celular'=>3115907753,
            // 'id_rol'=> 3 ,
            'password' => bcrypt('123'),
             "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('usuarios')->insert([
            'nombre'=>'Nancy Jhoanna Becerra Tamayo',
            'nombre_uno' =>'Nancy',
            'nombre_dos' => 'Jhoanna',
            'apellido_uno' => 'Becerra',
            'apellido_dos' => 'Tamayo',
            'email' => 'nancy@gmail.com',
            'tipo'=>'ES',
            'cedula'=>'1122353929',
            'sex'=>'F',
            'id_localizacion'=>1,
            'celular'=>3115907753,
            // 'id_rol'=> 3 ,
            'password' => bcrypt('123'),
             "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

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
