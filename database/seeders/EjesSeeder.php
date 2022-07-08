<?php

namespace Database\Seeders;

use App\Models\Eje;
use Illuminate\Database\Seeder;

class EjesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eje::create([
            'chaNombreEje' =>  'Académico'
        ]);
        Eje::create([
            'chaNombreEje' =>  'Prácticas'
        ]);
        Eje::create([
            'chaNombreEje' =>  'Investigación'
        ]);
        Eje::create([
            'chaNombreEje' =>  'Vinculación'
        ]);
    }
}
