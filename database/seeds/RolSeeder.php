<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
           "tipo"=>'AD',
            "nombre"=> "Administrador",
            "descripcion"=>"administrador del sistema tiene todos los privilegios.",
            "created_at" => new \DateTime(),
            "updated_at" => new \DateTime(),
        ]);

        DB::table('roles')->insert([
            "tipo"=>'PR',
             "nombre"=> "Profesor",
             "descripcion"=>"Profesor de la entidad.",
             "created_at" => new \DateTime(),
             "updated_at" => new \DateTime(),
         ]);

         DB::table('roles')->insert([
            "tipo"=>'ES',
             "nombre"=> "Estudiante",
             "descripcion"=>"Estudiante de la entidad.",
             "created_at" => new \DateTime(),
             "updated_at" => new \DateTime(),
         ]);

         DB::table('roles')->insert([
            "tipo"=>'SE',
             "nombre"=> "Secretaria(o)",
             "descripcion"=>"Secretario tiene los privilegios suficientes para soportar el sistema.",
             "created_at" => new \DateTime(),
             "updated_at" => new \DateTime(),
         ]);

         DB::table('rol_usuarios')->insert([
            "id_rol"=>1,
             "id_usuario"=> 1,
             "created_at" => new \DateTime(),
             "updated_at" => new \DateTime(),
         ]);
    }
}
