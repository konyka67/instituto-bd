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
            'nombre_uno' =>'juan',
            'nombre_dos' => 'camilo',
            'apellido_uno' => 'rodriguez',
            'apellido_dos' => 'diaz',
            'correo' => 'admin@gmail.com',
            'tipo'=>'AD',
            'cedula'=>'1022353924',
            'sex'=>'M',
            'contrasena' => bcrypt('123'),
        ]);
    }
}