<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tecnico.home')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechaAhora = date_create(date('Y-m-d'));
        $fechaCaducidad = date('Y-m-d',strtotime(date('Y-m-d')."+ 6 month")); 
        $fechaMesAntes = date('Y-m-d',strtotime(date('Y-m-d')."- 1 month"));
        $fechaInicioMes = date('Y-m-01');
        $fechaFinMes = date('Y-m-t',strtotime(date('Y-m-d')));
        $informesPendientes = null;
        $convenios = null;
        $conveniosCaducados = null;
        $conveniosPorCaducar = null;
        $conveniosNuevos = 0;
        $informesNuevos = 0;
        
        $convenios = Convenio::where('datFechaFinConvenio','>=',$fechaAhora)->get();
        $conveniosCaducados = Convenio::whereBetween('datFechaFinConvenio',[$fechaInicioMes,$fechaAhora])
        ->orderBy('datFechaFinConvenio', 'asc')->get();  
        $conveniosPorCaducar = Convenio::whereBetween('datFechaFinConvenio',[$fechaAhora,$fechaCaducidad])
        ->orderBy('datFechaFinConvenio','asc')->get();
        $i=0;
        foreach($conveniosPorCaducar as $convenio){
            $meses = floor(round((date_diff($fechaAhora,date_create($convenio->datFechaFinConvenio))->days)/30));
            if($meses == 6){
                $conveniosNuevos = $conveniosNuevos+1;
            }
            $convenio['meses'] = $meses . ' meses';
            $conveniosPorCaducar[$i] = $convenio;
            $i=$i+1;
        }       

        /**
         * Guarda los informes pendientes generados el día de hoy
         */
        foreach($convenios as $convenio){
            $informe = $convenio->informes()
            ->where('chaEstadoInforme','Pendiente')
            ->where('datFechaFinInforme','<=',$fechaFinMes)
            ->orderBy('datFechaFinInforme','asc')
            ->first();
            if(is_null($informe)==false){
                $informesPendientes[] = $informe;
                if($informe->datFechaFinInforme >= $fechaInicioMes && $informe->datFechaFinInforme <= $fechaFinMes){
                    $informesNuevos = $informesNuevos+1;
                }
            }
        }
        return view('tecnico.index', compact([
            'conveniosPorCaducar',
            'informesPendientes',
            'conveniosCaducados',
            'conveniosNuevos',
            'informesNuevos']));
    }
}
