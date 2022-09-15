<?php

namespace App\Http\Controllers\Auditor;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
use App\Models\Informe;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idConvenio)
    {
        $convenio = Convenio::findOrFail($idConvenio);
        $criterioParcial = 0;
        $criterioTotal = 0;
        $cumplimientoParcial = 0;
        $cumplimientoTotal = 0;
        $informesPendientes = null;
        $informesPresentados = null;
        $fechaFin = date_create($convenio->datFechaFinConvenio);
        $fechaAhora = date_create(date('Y-m-d'));

        /* Crea el siguiente informe en caso de necesitarlo, si es un convenio con tiempo de vigencia
        indeterminado*/
        if(isNull($convenio->datFechaFinConvenio)){
            $nInformes = $convenio->informes()->count();
            $meses = floor(round((date_diff(date_create($convenio->datFechaInicioConvenio),date_create(date('Y-m-d')))->days)/30));
            $n = floor($meses/6);
            if($nInformes < $n){
                $fechaUltimoInforme = $convenio->informes()->orderBy('datFechaFinInforme','desc')->pluck('datFechaFinInforme')->first();
                $fechaSiguienteInforme = date("Y-m-d",strtotime(date($fechaUltimoInforme)."+ 6 month"));
                Informe::create([
                    'idConvenio' => $convenio->idConvenio,
                    'datFechaInicioInforme' => $fechaUltimoInforme,
                    'datFechaFinInforme' => $fechaSiguienteInforme,
                    'chaEstadoInforme' => 'Pendiente'
                ]);
            }          
        }
        
        /* Calcula es estado según el tiempo del convenio */

        $tiempoEstado = floor(round((date_diff($fechaAhora,$fechaFin)->days)/30));

        if($convenio->datFechaFinConvenio==null){
            $estado = 'Vigente';
            $convenio['datFechaFinConvenio'] = 'Indeterminado';
        }elseif($fechaAhora > $fechaFin){
            $estado = 'Caducado';
        }elseif($tiempoEstado <= 6){
            $estado = 'Vigente - Por Caducar';
        }else{
            $estado = 'Vigente';
        }



        
        /* Recupera todos los informes del actual convenio*/
        $informes = Informe::where('idConvenio',$convenio->idConvenio)->get();
        
        /* Guarda todos los informes pendientes y presentados en arrays diferentes*/
        $i=1;
        $j=1;
        foreach($informes as $informe){
            if($informe->datFechaFinInforme <= date("Y-m-d")){
                /* Cuenta el numero de informes que debe tener hasta la fecha de hoy el convenio */
                $criterioParcial = $criterioParcial + 1;
                if($informe->chaEstadoInforme == 'Pendiente'){
                    /* Guarda en el array los informes pendientes del convenio hasta la fecha de hoy */
                    $informe['posicion'] = $i;
                    $informesPendientes[] = $informe;
                    $i=$i+1;
                }          
            }
            if($informe->chaEstadoInforme == 'Presentado'){
                $informe['posicion'] = $j;
                $informesPresentados[] = $informe;
                $j=$j+1;
            }
        }
        
        /* Cuenta el numero de informes que debe tener en total el convenio */
        $criterioTotal = count($informes);
        
        if(is_null($informesPresentados) == false){
        /* Calcula el número de informes presentados sobre criterio parcial */
            $cumplimientoParcial = floor((count($informesPresentados)/$criterioParcial)*100);

        /* Calcula el número de informes presentados sobre criterio total*/
            $cumplimientoTotal = floor((count($informesPresentados)/$criterioTotal)*100);
        }        

        /* Asigna las variables al objeto convenio para presentar en la vista */

        $convenio['estado'] = $estado;
        $convenio['criterioParcial'] = $criterioParcial;
        $convenio['criterioTotal'] = $criterioTotal;
        $convenio['cumplimientoParcial'] = $cumplimientoParcial;
        $convenio['cumplimientoTotal'] = $cumplimientoTotal;

        return view('auditor.show',compact([
        'convenio',
        'informesPresentados',
        'informesPendientes']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
