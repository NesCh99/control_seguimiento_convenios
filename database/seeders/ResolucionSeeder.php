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
            'chaNombreResolucion' =>  '590.CP.2019',
            'sinTipoResolucion' =>'1',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '039.CP.2021',
            'sinTipoResolucion' =>'1',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '053.CP.2021',
            'sinTipoResolucion' =>'1',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);
        Resolucion::create([
            'chaNombreResolucion' =>  '054.CP.2021',

            'sinTipoResolucion' =>'1',
            
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  '305.CP.2021',
        
            'sinTipoResolucion' =>'1',
            
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '545.CP.2021',
            
            'sinTipoResolucion' =>'1',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '3300.IDI.ESPOCH.2021',
          
            'sinTipoResolucion' =>'2',
            
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  'ESPOCH-DSO-2021-1220-O ',
           
            'sinTipoResolucion' =>'2',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);


        Resolucion::create([
            'chaNombreResolucion' =>  '3300.IDI.ESPOCH.2021',
            
            'sinTipoResolucion' =>'2',
           
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  ' 0121-D-FM-ESPOCH-2021',
           
            'sinTipoResolucion' =>'2',
            
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);

        Resolucion::create([
            'chaNombreResolucion' =>  ' ESPOCH-S0.CIVTCT-2021-0094-O',
          
            'sinTipoResolucion' =>'2',
          
            'tstCreacionResolucion' => $datenow,
            'tstModificacionResolucion' => $datenow
        ]);
    }
}
