<?php

namespace Database\Seeders;

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

        
        // \App\Models\User::factory(10)->create();
        $this->call(ClasificacionesSeeder::class);
        $this->call(EjesSeeder::class);
        $this->call(DependenciasSeeder::class);

        $this->call(CoordinadorSeeder::class);
        $this->call(ResolucionSeeder::class);
        $this->call(ConvenioSeeder::class);

        $this->call(RolSeeder::class);
        $this->call(UsuarioSeeder::class);
        

    }
}
