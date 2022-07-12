<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convenio;
use DateTime;
class ConvenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datenow = new DateTime();
        Convenio::create([
            'idClasificacion' =>  '1',
            'texNombreConvenio' =>  ' CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO “ESPOCH” Y LA UNIÓN PROVINCIAL DE COOPERATIVAS DE AHORRO Y CRÉDITO "UPROCACH” ',
            'datFechaInicioConvenio' => '2022-07-10',
            'datFechaFinConvenio' =>'2025-07-10',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);


        Convenio::create([
            'idClasificacion' =>  '2',
            'texNombreConvenio' =>  'Acuerdo de Cooperación entre la Escuela Superior Politécnica de Chimborazo y la Universidad Checa de Ciencias de la Vida Praga, Facultad de Ciencias Agrícolas Tropicales',
            'datFechaInicioConvenio' => '2022-07-10',
            'datFechaFinConvenio' =>'2025-07-10',
            'chaEstadoConvenio'=>'Vigente',
            'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);




        Convenio::create([
            'idClasificacion' =>  '3',
            'texNombreConvenio' =>  '“CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO “ESPOCH” Y YARA ECUADOR” ',
            'datFechaInicioConvenio' => '2022-07-10',
            'datFechaFinConvenio' =>'2025-07-10',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);





        Convenio::create([
            'idClasificacion' =>  '1',
            'texNombreConvenio' =>  'CONVENIO ESPECÍFICO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE UNIVERSIDAD DE LA CALABRIA Y LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO”',
            'datFechaInicioConvenio' => '2021-07-09',
            'datFechaFinConvenio' =>'2022-07-09',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);




     















    }
}
