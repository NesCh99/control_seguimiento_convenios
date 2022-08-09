<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use App\Models\Eje;
use App\Models\Convenio;
use App\Models\Coordinador;
use App\Models\Informe;
use App\Models\Resolucion;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ConvenioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tecnico.convenios.index')->only('index');
        $this->middleware('can:tecnico.convenios.create')->only('create');
        $this->middleware('can:tecnico.convenios.edit')->only('edit');
        $this->middleware('can:tecnico.convenios.show')->only('show');
        $this->middleware('can:tecnico.convenios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenio::all();
        $fecha2 = new DateTime();
        $i=0;
        foreach($convenios as $convenio){
            $coordinadorActual = $convenio->Coordinadores()->wherePivot('chaTipoCoordinador','Coordinador')->wherePivot('chaEstadoCoordinador','Activo')->get();
            $delegadoActual = $convenio->Coordinadores()->wherePivot('chaTipoCoordinador','Delegado')->wherePivot('chaEstadoCoordinador','Activo')->get();
            if(count($coordinadorActual)!=0){
                $convenio['Coordinador'] = $coordinadorActual[0];
                
            }else{
                $convenio['Coordinador'] = null;
            }
            if(count($delegadoActual)!=0){
                $convenio['Delegado'] = $delegadoActual[0];
            }else{
                $convenio['Delegado'] = null;
            }
            
            $convenio['Resolucion'] = $convenio->resolucion->chaNombreResolucion;
            $inicio = new DateTime($convenio->datFechaInicioConvenio);
            if(is_Null($convenio->datFechaFinConvenio)){
                $estado = 'Vigente';
                $convenio['datFechaFinConvenio'] = 'Indeterminado';
                $convenio['Vigencia'] = 'Indeterminado';
            }else{
                $fecha1 = new DateTime($convenio->datFechaFinConvenio);  
                $meses = $fecha2->diff($fecha1)->format('%r%y') * 12;
                if($convenio->datFechaFinConvenio <= date('Y-m-d')){
                    $estado = 'Caducado';
                }else if($meses > 0){
                    $estado = 'Vigente';
                }else if($meses >= 0 && $meses <= 6){
                    $estado = 'Vigente - Por Caducar';
                }
                $vigenciaAños = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%y');
                $vigenciaMeses = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%m');
                if($vigenciaMeses == 0){
                    $convenio['Vigencia'] = $vigenciaAños.' años ';
                }else{
                    $convenio['Vigencia'] = $vigenciaAños.' años '.$vigenciaMeses. ' meses';
                }
            }
            $convenio['Estado'] = $estado;
            $convenios[$i] = $convenio;
            $i++;
        }
        return view('tecnico.convenios.index', compact('convenios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $clasificaciones = Clasificacion::pluck('chaNombreClasificacion','idClasificacion')->toArray();
        $ejes = Eje::all();
        $resoluciones = Resolucion::where('sinTipoResolucion','=','1')->pluck('chaNombreResolucion')->toArray();
        return view('tecnico.convenios.create', compact(['clasificaciones',
                                                        'ejes',
                                                        'resoluciones' ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        /**
         * Valida los campos nombre, objeto, fecha y resolucion
         */
        $request->validate([
            'Nombre' => 'required|string|max:500|unique:v_convenios,texNombreConvenio',
            'Objeto' => 'required|string|max:500',
            'Fecha' => 'required|date',
            'Resolucion' => 'required|string|exists:v_resoluciones,chaNombreResolucion'
        ]);
        $resolucion = Resolucion::where('chaNombreResolucion','=',$request->input('Resolucion'))->get();
        

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
        
        if($request->input('indeterminado') == 'true'){
            $fechaFin = null;
        }else{
            $años = $request->input('Años');
            $meses = $request->input('Meses');

            if($años == 0 && $meses == 0){ //Años y Meses no pueden ser 0, solo uno de los 2
                $request->validate([
                    'Años' => 'gt:0',
                    'Meses' => 'gt:0'
                ]);
            }
            $fechaFin = date("Y-m-d",strtotime($request->input('Fecha')."+ ".$request->input('Años')." year"."+ ".$request->input('Meses')." month"));//Devuelve la fecha final en funcion del tiempo de vigencia
        }
        
        
        /**
         * Valida los ejes ingresados, cuando no se escoge internacional
         */
        $id = $request->input('Clasificacion');
        $clasificacion = Clasificacion::find($id);
        if($clasificacion->idClasificacion != 3){
            $request->validate([
                'ejes' => 'required'
            ]);
        }
        
        /**
         * Registra el convenio en la base de datos
         */
        $convenio = Convenio::create([
            'idClasificacion' => $request->input('Clasificacion'),
            'idResolucion' => $resolucion[0]->idResolucion,
            'texNombreConvenio' => $request->input('Nombre'),
            'texObjetoConvenio' => $request->input('Objeto'),
            'datFechaInicioConvenio' => $request->input('Fecha'),
            'datFechaFinConvenio' => $fechaFin,
            'texUrlConvenio' => $link,
            'chaEstadoConvenio' => 'Vigente'
        ]);
        
        $convenio->ejes()->sync($request->input('ejes')); //Asigna los ejes escogidos al convenio registrado

        //Creación de todos los Informes que tiene el convenio desde su inicio, hasta su fin
        if(is_null($fechaFin)){
            /* Crea los informes del convenio cuando tiene un tiempo de fin indeterminado
                Los informes son cada 6 meses desde el inicio del convenio hasta la fecha actual
                de la creación del convenio 
            */
            $meses = floor(round((date_diff(date_create($convenio->datFechaInicioConvenio),date_create(date('Y-m-d')))->days)/30));
            $nInformes = floor($meses/6);
            if($nInformes == 0){
                /* En caso de que el intervalo de tiempo entre la fecha de inicio del convenio
                y la fecha de hoy, es menor a 6 meses, se crea solo un informe */
                $nInformes = $nInformes + 1;
            }
            $fechaInicio = $convenio->datFechaInicioConvenio;
            $fechaFin = date("Y-m-d",strtotime(date($fechaInicio)."+ 6 month"));

            for($i=0; $i<$nInformes; $i++){
                $informes[] = ([
                    'idConvenio' => $convenio->idConvenio,
                    'datFechaInicioInforme' => $fechaInicio,
                    'datFechaFinInforme' => $fechaFin,
                    'chaEstadoInforme' => 'Pendiente'
                ]);
                $fechaInicio = $fechaFin;
                $fechaFin = date("Y-m-d",strtotime(date($fechaInicio)."+ 6 month"));
            }
        }else{
            $fechaInicio = $convenio->datFechaInicioConvenio;
            $fechaFin = date("Y-m-d",strtotime(date($fechaInicio)."+ 6 month"));

            $nMeses = $años*12 + $meses;
            if($nMeses%6 == 0){
                //Crea Informes cuando son años cerrados sin meses
                $nInformes = floor($nMeses/6);
                for($i=0; $i<$nInformes; $i++){
                    $informes[] = ([
                        'idConvenio' => $convenio->idConvenio,
                        'datFechaInicioInforme' => $fechaInicio,
                        'datFechaFinInforme' => $fechaFin,
                        'chaEstadoInforme' => 'Pendiente'
                    ]);
                    $fechaInicio = $fechaFin;
                    $fechaFin = date("Y-m-d",strtotime(date($fechaInicio)."+ 6 month"));
                }
            }else{
                //Crea los informes cuando son años con meses
                $nInformes = floor($nMeses/6);
                for($i=0; $i<$nInformes; $i++){
                    $informes[] = ([
                        'idConvenio' => $convenio->idConvenio,
                        'datFechaInicioInforme' => $fechaInicio,
                        'datFechaFinInforme' => $fechaFin,
                        'chaEstadoInforme' => 'Pendiente'
                    ]);
                    $fechaInicio = $fechaFin;
                    $fechaFin = date("Y-m-d",strtotime(date($fechaInicio)."+ 6 month"));
                }
                $informes[] = ([
                    'idConvenio' => $convenio->idConvenio,
                    'datFechaInicioInforme' => $fechaInicio,
                    'datFechaFinInforme' => $convenio->datFechaFinConvenio,
                    'chaEstadoInforme' => 'Pendiente'
                ]);   
            }
        }
        Informe::insert($informes); 
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info', 'El Convenio ha sido registrado con éxito, porfavor asigne coordinadores');
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

        return view('tecnico.convenios.show',compact([
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
        $convenio = Convenio::find($id);    
        $clasificaciones = Clasificacion::pluck('chaNombreClasificacion', 'idClasificacion')->toArray();
        $ejes = Eje::all();
        $resoluciones = Resolucion::all()->pluck('chaNombreResolucion')->toArray(); //Envia las resoluciones para el autocompletar
        $idsCoordinadores = $convenio->coordinadores->pluck('idCoordinador')->toArray();
        $coordinadores = Coordinador::whereNotIn('idCoordinador', $idsCoordinadores)->get();
        $coordinadoresActuales = $convenio->coordinadores()->orderBy('v_convenios_coordinadores.chaEstadoCoordinador','asc')->get();
        if(is_Null($convenio->datFechaFinConvenio)){
            $vigenciaAños = null;
            $vigenciaMeses = null;
        }else{
            $inicio = new DateTime($convenio->datFechaInicioConvenio);
            $vigenciaAños = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%y');
            $vigenciaMeses = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%m');
        }
        $convenio['años'] = $vigenciaAños;
        $convenio['meses'] = $vigenciaMeses;
        return view('tecnico.convenios.edit',compact([  'convenio',
                                                        'clasificaciones',
                                                        'ejes',
                                                        'resoluciones',
                                                        'coordinadores',
                                                        'coordinadoresActuales']));
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
            'Objeto' => 'required|string|max:500',
            'Fecha' => 'required|date',
            'Resolucion' => 'required|string|exists:v_resoluciones,chaNombreResolucion'
        ]);
        $resolucion = Resolucion::where('chaNombreResolucion','=',$request->input('Resolucion'))->get();

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
        /* Validacion de tiempo de Vigencia */
        
        if($request->input('indeterminado') == 'true'){
            $fechaFin = null;
        }else{
            $años = $request->input('Años');
            $meses = $request->input('Meses');

            if($años == 0 && $meses == 0){ //Años y Meses no pueden ser 0, solo uno de los 2
                $request->validate([
                    'Años' => 'gt:0',
                    'Meses' => 'gt:0'
                ]);
            }
            $fechaFin = date("Y-m-d",strtotime($request->input('Fecha')."+ ".$request->input('Años')." year"."+ ".$request->input('Meses')." month"));//Devuelve la fecha final en funcion del tiempo de vigencia
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
        
        /* Crea de nuevo los informes del convenio en caso de cambiarse las fechas */
        if( $convenio->datFechaInicioConvenio != $request->input('Fecha') || $convenio->datFechaFinConvenio != $fechaFin){
            if(is_null($fechaFin)){
                /* Crea los informes del convenio cuando tiene un tiempo de fin indeterminado
                    Los informes son cada 6 meses desde el inicio del convenio hasta la fecha actual
                    de la creación del convenio 
                */
                $meses = floor(round((date_diff(date_create($request->input('Fecha')),date_create(date('Y-m-d')))->days)/30));
                $nInformes = floor($meses/6);
                if($nInformes == 0){
                    /* En caso de que el intervalo de tiempo entre la fecha de inicio del convenio
                    y la fecha de hoy, es menor a 6 meses, se crea solo un informe */
                    $nInformes = $nInformes + 1;
                }
                $fechaInicioInforme = $request->input('Fecha');
                $fechaFinInforme = date("Y-m-d",strtotime(date($fechaInicioInforme)."+ 6 month"));
    
                for($i=0; $i<$nInformes; $i++){
                    $informes[] = ([
                        'idConvenio' => $convenio->idConvenio,
                        'datFechaInicioInforme' => $fechaInicioInforme,
                        'datFechaFinInforme' => $fechaFinInforme,
                        'chaEstadoInforme' => 'Pendiente'
                    ]);
                    $fechaInicioInforme = $fechaFinInforme;
                    $fechaFinInforme = date("Y-m-d",strtotime(date($fechaInicioInforme)."+ 6 month"));
                }
            }else{
                $fechaInicioInforme = $request->input('Fecha');
                $fechaFinInforme = date("Y-m-d",strtotime(date($fechaInicioInforme)."+ 6 month"));
    
                $nMeses = $años*12 + $meses;
                if($nMeses%6 == 0){
                    //Crea Informes cuando son años cerrados sin meses
                    $nInformes = floor($nMeses/6);
                    for($i=0; $i<$nInformes; $i++){
                        $informes[] = ([
                            'idConvenio' => $convenio->idConvenio,
                            'datFechaInicioInforme' => $fechaInicioInforme,
                            'datFechaFinInforme' => $fechaFinInforme,
                            'chaEstadoInforme' => 'Pendiente'
                        ]);
                        $fechaInicioInforme = $fechaFinInforme;
                        $fechaFinInforme = date("Y-m-d",strtotime(date($fechaInicioInforme)."+ 6 month"));
                    }
                }else{
                    //Crea los informes cuando son años con meses
                    $nInformes = floor($nMeses/6);
                    for($i=0; $i<$nInformes; $i++){
                        $informes[] = ([
                            'idConvenio' => $convenio->idConvenio,
                            'datFechaInicioInforme' => $fechaInicioInforme,
                            'datFechaFinInforme' => $fechaFinInforme,
                            'chaEstadoInforme' => 'Pendiente'
                        ]);
                        $fechaInicioInforme = $fechaFinInforme;
                        $fechaFinInforme = date("Y-m-d",strtotime(date($fechaInicioInforme)."+ 6 month"));
                    }
                    $informes[] = ([
                        'idConvenio' => $convenio->idConvenio,
                        'datFechaInicioInforme' => $fechaInicioInforme,
                        'datFechaFinInforme' => $fechaFin,
                        'chaEstadoInforme' => 'Pendiente'
                    ]);   
                }
            }
            $idsInformes = $convenio->informes()->pluck('idInforme')->toArray();
            $convenio->informes()->whereIn('idInforme', $idsInformes)->delete();
            Informe::insert($informes); 
        }

        /* Actualiza el onvenio */

        $convenio->update([
            'idClasificacion' => $request->input('idClasificacion'),
            'idResolucion' => $resolucion[0]->idResolucion,
            'texNombreConvenio' => $request->input('Nombre'),
            'texObjetoConvenio' => $request->input('Objeto'),
            'datFechaInicioConvenio' => $request->input('Fecha'),
            'datFechaFinConvenio' => $fechaFin,
            'texUrlConvenio' => $link,
            'chaEstadoConvenio' => 'Vigente'
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

    /* Funcion que asigna coordinadores a los convenios */
    public function asignarCoordinador(Request $request, $idConvenio, $idCoordinador){
        $convenio = Convenio::find($idConvenio);
        $request->validate([
            'resolucion'.$idCoordinador => 'required'
        ]);
        $resolucion = $request->input('resolucion'.$idCoordinador);
        $tipo = $request->input('Tipo');
        $ids = $convenio->coordinadores()->wherePivot('chaTipoCoordinador','=',$tipo)->allRelatedIds();
        foreach($ids as $id){
            $convenio->coordinadores()->updateExistingPivot($id, ['chaEstadoCoordinador' => 'Inactivo']);
        }
        $convenio->coordinadores()->attach($idCoordinador, ['chaTipoCoordinador' => $tipo,'chaEstadoCoordinador' => 'Activo', 'chaNombreResolucion' => $resolucion]);
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','Coordinador asignado exitosamente');
    }
    /* Funcion que quita coordinadores a los convenios */
    public function quitarCoordinador($idConvenio, $idCoordinador){
        $convenio = Convenio::find($idConvenio);
        $coordinador = $convenio->coordinadores()->wherePivot('idCoordinador',$idCoordinador)->get();
        if($coordinador[0]->pivot->chaEstadoCoordinador == 'Inactivo'){
            $convenio->coordinadores()->detach($idCoordinador);
        }else{
            $ids = $convenio->coordinadores()->wherePivot('chaEstadoCoordinador', 'Inactivo')
            ->wherePivot('chaTipoCoordinador',$coordinador[0]->pivot->chaTipoCoordinador)->allRelatedIds();
            if(count($ids)!=0){
                $convenio->coordinadores()->updateExistingPivot($ids[0], ['chaEstadoCoordinador' => 'Activo']);
            }
            $convenio->coordinadores()->detach($idCoordinador);
        }
        return redirect()->route('tecnico.convenios.edit', $convenio)->with('info','Coordinador quitado exitosamente');
    }

    /* Funcion que asigna las resoluciones a los convenios */
    public function asignarInforme($idConvenio, $idInforme){
        $convenio = Convenio::findOrFail($idConvenio);
        $informe = Informe::findOrFail($idInforme);
        $informe->update([
            'chaEstadoInforme' => 'Presentado'
        ]);
        return redirect()->route('tecnico.convenios.show', $convenio)->with('info','El del '.$informe->datFechaInicioInforme.' al '.$informe->datFechaFinInforme.' se ha presentado con éxito');
    }

    /* Funcion que quita las resoluciones a los convenios */
    public function quitarInforme($idConvenio, $idInforme){
        $convenio = Convenio::find($idConvenio);
        $informe = Informe::findOrFail($idInforme);
        $informe->update([
            'chaEstadoInforme' => 'Pendiente'
        ]);
        return redirect()->route('tecnico.convenios.show', $convenio)->with('info','El del '.$informe->datFechaInicioInforme.' al '.$informe->datFechaFinInforme.' se ha presentado con éxito');
    }
}

