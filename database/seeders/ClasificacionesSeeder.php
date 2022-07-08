<?php

namespace Database\Seeders;

use App\Models\Clasificacion;
use Illuminate\Database\Seeder;

class ClasificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clasificacion::create([
            'chaNombreClasificacion' => 'Marco',
        ]);
        Clasificacion::create([
            'chaNombreClasificacion' => 'Específico',
        ]);
        Clasificacion::create([
            'chaNombreClasificacion' => 'Internacional',
        ]);
    }
}
