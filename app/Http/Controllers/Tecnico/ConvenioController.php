<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use App\Models\Eje;
use App\Models\Convenio;
use App\Models\Coordinador;
use App\Models\Informe;
use App\Models\Resolucion;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenio::all();
        return view('tecnico.convenios.index', compact('convenios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $clasificaciones = Clasificacion::all();
        $ejes = Eje::all();
        return view('tecnico.convenios.create', compact(['clasificaciones',
                                                        'ejes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $request->validate([
            'Nombre' => 'required|string|max:500|unique:v_convenios,texNombreConvenio',
            'Fecha' => 'required|date',
        ]);

        /**
         * Validación del Link del Documento
         */

        if(strlen($request->input('Link')) == 0){
            $link = 'Sin Link';
        }else{
            $request->validate([
                'Link' => 'url'
            ]);
            $link = $request->input('Link');
        }

        /* Validacion de tiempo de Vigencia */
        $años = $request->input('Años');
        $meses = $request->input('Meses');

        if($años == 0 && $meses == 0){ //Años y Meses no pueden ser 0, solo uno de los 2
            $request->validate([
                'Años' => 'gt:0',
                'Meses' => 'gt:0'
            ]);
        }

        /**
         * Valida los ejes ingresados, cuando no se escoge internacional
         */
        $id = $request->input('Clasificacion');
        $clasificacion = Clasificacion::find($id);
        if(strcmp($clasificacion->chaNombreClasificacion,'Internacional')!=0){
            $request->validate([
                'ejes' => 'required'
            ]);
        }

        $fechafin = date("Y-m-d",strtotime($request->input('Fecha')."+ ".$request->input('Años')." year"."+ ".$request->input('Meses')." month"));//Devuelve la fecha final en funcion del tiempo de vigencia
        
        $convenio = Convenio::create([
            'idClasificacion' => $request->input('Clasificacion'),
            'texNombreConvenio' => $request->input('Nombre'),
            'datFechaInicioConvenio' => $request->input('Fecha'),
            'datFechaFinConvenio' => $fechafin,
            'texUrlConvenio' => $link,
            'chaEstadoConvenio' => 'Vigente'
        ]);
        
        $convenio->ejes()->sync($request->input('ejes')); //Asigna los ejes escogidos al convenio registrado
        
        /* Creación de Informes */
        $fechaInicio = date_create($convenio->datFechaInicioConvenio);
        $fechaFin = date_create($convenio->datFechaFinConvenio);
        $criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
        $criterioTotal = floor($criterioTotal/6);

        $fechaBand = $convenio->datFechaInicioConvenio;
        for($i = 0; $i<$criterioTotal; $i++){ 
            $fechaBand2 = $fechaBand;
            $fechaBand = date("Y-m-d",strtotime($fechaBand."+ 6 month"));
            $descripcion = 'INFORME DEL '. $fechaBand2.' AL '.$fechaBand;
            Informe::create([
                'idConvenio' => $convenio->idConvenio,
                'texDescripcionInforme' => $descripcion,
                'chaEstadoInforme' => 'Pendiente',
                'datFechaPresentacionInforme' => $fechaBand
            ]); 
        }
        
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info', 'El Convenio ha sido registrado con éxito, porfavor asigne resoluciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $convenio = Convenio::find($id);
        $fechaInicio = date_create($convenio->datFechaInicioConvenio);
        $fechaFin = date_create($convenio->datFechaFinConvenio);
        $fechaAhora = date_create(date('Y-m-d'));
        $criterioParcial = round((date_diff($fechaInicio,$fechaAhora)->days)/30);
        $criterioParcial = floor($criterioParcial/6);
        $criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
        $criterioTotal = floor($criterioTotal/6);
        $nInformesPresentados = count($convenio->informes->where('chaEstadoInforme','Presentado'));
        if($nInformesPresentados==0){
            $cumplimientoParcial = 0;
            $cumplimientoTotal = 0;
        }else{
            $cumplimientoParcial = ($nInformesPresentados/$criterioParcial)*100;
            $cumplimientoTotal = ($nInformesPresentados/$criterioTotal)*100;
        }
        $tiempoEstado = floor(round((date_diff($fechaAhora,$fechaFin)->days)/30));
        if($fechaAhora > $fechaFin){
            $estado = 'Caducado';
        }elseif($tiempoEstado <= 6){
            $estado = 'Por Caducar';
        }else{
            $estado = 'Vigente';
        }

        $informes = Informe::where('idConvenio',$convenio->idConvenio)->where('chaEstadoInforme','Pendiente')->where('datFechaPresentacionInforme','<=',$fechaAhora)->get();
        $informesPresentados = Informe::where('idConvenio',$convenio->idConvenio)->where('chaEstadoInforme','Presentado')->get();
        return view('tecnico.convenios.show',compact([
        'convenio',
        'criterioParcial',
        'criterioTotal',
        'cumplimientoParcial',
        'cumplimientoTotal',
        'estado',
        'informes',
        'informesPresentados']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio = Convenio::find($id);    
        $clasificaciones = Clasificacion::pluck('chaNombreClasificacion', 'idClasificacion')->toArray();
        $ejes = Eje::all();
        $resoluciones = Resolucion::all()->pluck('chaNombreResolucion')->toArray(); //Envia las resoluciones para el autocompletar
        $idsResoluciones = $convenio->resoluciones->pluck('idResolucion')->toArray();
        $resoluciones2 = Resolucion::whereNotIn('idResolucion',$idsResoluciones)->get();
        $idsCoordinadores = $convenio->coordinadores->pluck('idCoordinador')->toArray();
        $coordinadores = Coordinador::whereNotIn('idCoordinador', $idsCoordinadores)->get();
        return view('tecnico.convenios.edit',compact([  'convenio',
                                                        'clasificaciones',
                                                        'ejes',
                                                        'resoluciones',
                                                        'resoluciones2',
                                                        'coordinadores']));
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
        $convenio = Convenio::find($id);

        $request->validate([
            'Nombre' => "required|string|max:500|unique:v_convenios,texNombreConvenio,$convenio->idConvenio,idConvenio",
            'Fecha' => 'required|date'
        ]);

        /**
         * Validación del Link al Documeno
         */
        if(strlen($request->input('Link')) == 0){
            $link = 'Sin Link';
        }else{
            $request->validate([
                'Link' => 'url'
            ]);
            $link = $request->input('Link');
        }
        
        $años = $request->input('Años');
        $meses = $request->input('Meses');

        if($años == 0 && $meses == 0){ //Años y Meses no pueden ser 0, solo uno de los 2
            $request->validate([
                'Años' => 'gt:0',
                'Meses' => 'gt:0'
            ]);
        }
        /**
         * Valida los ejes ingresados, cuando no se escoge internacional
         */
        $idClasificacion = $request->input('idClasificacion');
        $clasificacion = Clasificacion::find($idClasificacion);
        if(strcmp($clasificacion->chaNombreClasificacion,'Internacional')!=0){
            $request->validate([
                'ejes' => 'required'
            ]);
        }

        $fechafin = date("Y-m-d",strtotime($request->input('Fecha')."+ ".$request->input('Años')." year"."+ ".$request->input('Meses')." month"));//Devuelve la fecha final en funcion del tiempo de vigencia

        $convenio->update([
            'idClasificacion' => $request->input('idClasificacion'),
            'texNombreConvenio' => $request->input('Nombre'),
            'datFechaInicioConvenio' => $request->input('Fecha'),
            'datFechaFinConvenio' => $fechafin,
            'texUrlConvenio' => $link,
            
        ]);
        
        $convenio->ejes()->sync($request->input('ejes')); //Asigna los ejes escogidos al convenio registrado
        
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info', 'El Convenio ha sido actualizado con éxito');
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

    /* Funcion que asigna las resoluciones a los convenios */
    public function asignarResolucion( $idConvenio, $idResolucion){
        $convenio = Convenio::find($idConvenio);
        $convenio->resoluciones()->attach($idResolucion);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','La resolución se ha asignado con éxito');
    }

    /* Funcion que quita las resoluciones a los convenios */
    public function quitarResolucion($idConvenio, $idResolucion){
        $convenio = Convenio::find($idConvenio);
        $convenio->resoluciones()->detach($idResolucion);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','La resolución se ha quitado con éxito');
    }

    /* Funcion que asigna coordinadores a los convenios */
    public function asignarCoordinador($idConvenio, $idCoordinador){
        $convenio = Convenio::find($idConvenio);
        $ids = $convenio->coordinadores()->allRelatedIds();
        foreach($ids as $id){
            $convenio->coordinadores()->updateExistingPivot($id, ['chaEstadoCoordinador' => 'Delegado']);
        }
        $convenio->coordinadores()->attach($idCoordinador, ['chaEstadoCoordinador' => 'Coordinador']);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','Coordinador asignado exitosamente');
    }
    /* Funcion que quita coordinadores a los convenios */
    public function quitarCoordinador($idConvenio, $idCoordinador){
        $convenio = Convenio::find($idConvenio);
        $convenio->coordinadores()->detach($idCoordinador);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','Coordinador quitado exitosamente');
    }

    /* Funcion que asigna las resoluciones a los convenios */
    public function asignarInforme($idConvenio, $idInforme){
        $convenio = Convenio::find($idConvenio);
        $informe = Informe::find($idInforme);
        $informe->update([
            'chaEstadoInforme' => 'Presentado'
        ]);
        return redirect()->route('tecnico.convenios.show', $convenio)->with('info','El '.$informe->texDescripcionInforme.' se ha presentado con éxito');
    }

    /* Funcion que quita las resoluciones a los convenios */
    public function quitarInforme(Request $request, $idConvenio){
        $convenio = Convenio::find($idConvenio);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','La resolución se ha quitado con éxito');
    }
}

