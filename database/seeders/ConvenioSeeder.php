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
            
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  '  CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO “ESPOCH” Y LA UNIÓN PROVINCIAL DE COOPERATIVAS DE AHORRO Y CRÉDITO "UPROCACH” ',
            'datFechaInicioConvenio' => '2021-02-10',
            'datFechaFinConvenio' =>'2026-02-10',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);


        Convenio::create([
             'idClasificacion' =>  '1',
     
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'Acuerdo de Cooperación entre la Escuela Superior Politécnica de Chimborazo y la Universidad Checa de Ciencias de la Vida Praga, Facultad de Ciencias Agrícolas Tropicales',
            'datFechaInicioConvenio' => '2021-02-25',
            'datFechaFinConvenio' =>'2026-02-25',
            'chaEstadoConvenio'=>'Vigente',
            'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);




        Convenio::create([
             'idClasificacion' =>  '1',
        
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO “ESPOCH” Y YARA ECUADOR',
            'datFechaInicioConvenio' => '2021-03-16',
            'datFechaFinConvenio' =>'2023-03-16',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);





        Convenio::create([
             'idClasificacion' =>  '1',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
          
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO - ESPOCH Y LA UNIDAD EDUCATIVA NUESTRO MUNDO ECO RIO -UENMER',
            'datFechaInicioConvenio' => '2021-04-12',
            'datFechaFinConvenio' =>'2026-04-12',
            'chaEstadoConvenio'=>'Vigente',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);



        Convenio::create([
              'idClasificacion' =>  '2',
           
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO ESPECÍFICO COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO ESPOCH/FACULTAD  DE MECÁNICA Y LA EMPRESA PÚBLICA MUNICIPAL DE AGUA POTABLE Y ALCANTARILLADO DE RIOBAMBA “EP-EMAPAR”',
            'datFechaInicioConvenio' => '2020-01-07',
            'datFechaFinConvenio' =>'2021-01-07',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
        


        Convenio::create([
              'idClasificacion' =>  '2',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO ESPECÍFICO PARA PRÁCTICAS PRE PROFESIONALES ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO  Y EL GOBIERNO AUTÓNOMO DESCENTRALIZADO DE LA PROVINCIA DE CHIMBORAZO',
            'datFechaInicioConvenio' => '2020-07-15',
            'datFechaFinConvenio' =>'2025-07-15',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
       

        Convenio::create([
             'idClasificacion' =>  '1',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO “ESPOCH” Y EL GAD MUNICIPAL DE CHAMBO',
            'datFechaInicioConvenio' => '2020-02-18',
            'datFechaFinConvenio' =>'2022-02-18',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
   


        
        Convenio::create([
            'idClasificacion' =>  '3',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO  ENTRE LA ESCUELA SUPERIOR POLITECNICA DE CHIMBORAZO Y LA UNIVERSITAT DE VALÉNCIA (ESPAÑA), CONVENI ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO I LA UNIVERSITAT DE VALENCIA (ESPANYA).',
            'datFechaInicioConvenio' => '2021-02-19',
            'datFechaFinConvenio' =>'2025-02-19',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
       

         
        Convenio::create([
            'idClasificacion' =>  '3',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO  ENTRE LA ESCUELA SUPERIOR POLITECNICA DE CHIMBORAZO Y LA UNIVERSITAT DE VALÉNCIA (ESPAÑA), CONVENI ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO I LA UNIVERSITAT DE VALENCIA (ESPANYA).',
            'datFechaInicioConvenio' => '2021-02-19',
            'datFechaFinConvenio' =>'2025-02-19',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
       


        Convenio::create([
             'idClasificacion' =>  '1',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA SUPERINTENDENCIA DE BANCOS Y LA ESCUELA SUPERIOR POLITÉCNICA CHIMBORAZO',
            'datFechaInicioConvenio' => '2019-02-18',
            'datFechaFinConvenio' =>'2021-02-18',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);
         


        Convenio::create([
             'idClasificacion' =>  '1',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN CIENTÍFICA, EDUCACIÓN Y CULTURA ENTRE LA UNIVERSIDAD DE TRANSILVANIA  DE BRASOV Y LA ESCUELA SUPERIOR POLITÉCNICA CHIMBORAZO',
            'datFechaInicioConvenio' => '2019-02-14',
            'datFechaFinConvenio' =>'2022-02-14',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);



        
        Convenio::create([
              'idClasificacion' =>  '2',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  ' CONVENIO ESPECÍFICO DE COOPERACIÓN INSTERINSTITUCIONAL ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO Y LA FUNDACIÓN MAQUITA CUSHUNCHIC COMERCIALIZANDO COMO HERMANOS (MAQUITA), EN EL MARCO DE LA EJECUCIÓN DEL CONVENIO DE DESARROLLO “PRODUCCIÓN ECOLÓGICA, COMERCIO JUSTO Y CONSUMO RESPONSABLE, EN ECUADOR,',
            'datFechaInicioConvenio' => '2019-01-30',
            'datFechaFinConvenio' =>'2021-01-30',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);


        Convenio::create([
              'idClasificacion' =>  '2',
            'texObjetoConvenio'=> 'It is a long established fact that a reader will be distracted by the',
            'texNombreConvenio' =>  'CONVENIO MARCO DE COOPERACIÓN INTERINSTITUCIONAL CELEBRADO ENTRE LA ESCUELA SUPERIOR POLITÉCNICA DE CHIMBORAZO Y EL GOBIERNO AUTÓNOMO DESCENTRALIZADO MUNICIPAL DE RIOBAMBA PARA DESARROLLAR PROYECTOS EN EL ÁMBITO DE LA INVESTIGACIÓN CIENTÍFICA Y TECNOLÓGICA',
            'datFechaInicioConvenio' => '2019-11-11',
            'datFechaFinConvenio' =>'2023-11-11',
            'chaEstadoConvenio'=>' ',
           'texUrlConvenio'=>'https://liveespochedu-my.sharepoint.com/:w:/g/personal/klever_castillo_espoch_edu_ec/EekWPrZQzzRJvgvIzPZ2OjwBLs2_1Vz3Py9CspNidVFT0w?e=8f3EBx',
            'tstCreacionConvenio' => $datenow,
            'tstModificacionConvenio' => $datenow
        ]);




     















    }
}
