<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $this->call(Pais::class);
         $this->call(Departamentos::class);
         $this->call(Ciudads::class);
         $this->call(Localizacions::class);
         $this->call(Materias::class);
         $this->call(Planes::class);
         $this->call(UsuariosTableSeeder::class);
         $this->call(ConfiguracionSeeder::class);

    }
}
