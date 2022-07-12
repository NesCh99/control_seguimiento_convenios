<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resolucion;
use DateTime;
class ResolucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datenow = new DateTime();
       

        Resolucion::create([
            'chaNombreResolucion' =>  '020.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '021.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '022.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);
        Resolucion::create([
            'chaNombreResolucion' =>  '023.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '024.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '025.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'1',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '026.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'2',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '027.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'2',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '028.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'2',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '029.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'2',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '030.CP.2021',
            'texObjetoResolucion' => 'Lorem ipsum dolor sit amet.',
            'sinTipoResolucion' =>'2',
            'texUrlResolucion'=>' ',
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);
    }
}
