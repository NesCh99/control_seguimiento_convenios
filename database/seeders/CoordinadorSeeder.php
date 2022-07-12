<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coordinador;
use DateTime;
class CoordinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datenow = new DateTime();
        Coordinador::create([
            'idDependencia' =>  '1',
            'chaNombreCoordinador' => ' José Gabriel Pilaguano Mendoza',
            'chaTituloCoordinador' =>'Ingeniero',
            'chaCargoCoordinador'=>'Docente',
            'chaCelularCoordinador'=>'0983418757',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);



        Coordinador::create([
            'idDependencia' =>  '3',
            'chaNombreCoordinador' => 'Juan Carlos Carrasco',
            'chaTituloCoordinador' =>'Ingeniero',
            'chaCargoCoordinador'=>'Docente',
            'chaCelularCoordinador'=>'0683418478',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);


        Coordinador::create([
            'idDependencia' =>  '3',
            'chaNombreCoordinador' => 'Alfonso  Suarez',
            'chaTituloCoordinador' =>'Ingeniero',
            'chaCargoCoordinador'=>'Docente',
            'chaCelularCoordinador'=>'0893418658',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);



        Coordinador::create([
            'idDependencia' =>  '10',
            'chaNombreCoordinador' => 'Luis Hidalgo Almeida',
            'chaTituloCoordinador' =>'Ingeniero',
            'chaCargoCoordinador'=>'Director',
            'chaCelularCoordinador'=>'0893418785',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);


        Coordinador::create([
            'idDependencia' =>  '9',
            'chaNombreCoordinador' => 'Magdy Mileni Echeverria Guadalupe',
            'chaTituloCoordinador' =>'Dra.',
            'chaCargoCoordinador'=>'Director',
            'chaCelularCoordinador'=>'0893418432',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);
    


        Coordinador::create([
            'idDependencia' =>  '7',
            'chaNombreCoordinador' => 'Celin Padilla',
            'chaTituloCoordinador' =>'Ing.',
            'chaCargoCoordinador'=>'Vicerrector Académico',
            'chaCelularCoordinador'=>'0893418432',
            'tstCreacionCoordinador' => $datenow,
            'tstModificacionCoordinador' => $datenow
        ]);
    
    
    
    
    }
}
