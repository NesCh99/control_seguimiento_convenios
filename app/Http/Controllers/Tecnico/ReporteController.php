<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convenio;
use App\Models\Informe;
use App\Models\Clasificacion;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $fechaAhora = date_create(date('Y-m-d'));
    $conveniosTotales = Convenio::all();
    $convenios = Convenio::where('datFechaFinConvenio','>=',$fechaAhora)->get();
    $clasificacion = Clasificacion::all();

    
    

    $convenioMarco = $convenios->where('idClasificacion','1');
    $convenioEspecifico = $convenios->where('idClasificacion','2');
    $convenioInternacional = $convenios->where('idClasificacion','3');
    

    if(is_null($request->input('Año'))){
      $convenioCumplimiento = Convenio::whereYear('datFechaInicioConvenio','2022')->get();
    }else{
      $convenioCumplimiento = Convenio::whereYear('datFechaInicioConvenio',$request->input('Año'))->get();
    }
        
     $cumplimientoMarco = $convenioCumplimiento->where('idClasificacion','1');
     $cumplimientoEspecifico = $convenioCumplimiento->where('idClasificacion','2');
     $cumplimientoInternacional = $convenioCumplimiento->where('idClasificacion','3');

     $cumplimientoMarcoParcialGraph = array();
     $cumplimientoMarcoTotalGraph = array();
    foreach( $cumplimientoMarco as $convenioNivel ){
        $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
								$fechaFin = date_create($convenioNivel->datFechaFinConvenio);
								$fechaAhora = date_create(date('Y-m-d'));
								$criterioParcial = round((date_diff($fechaInicio,$fechaAhora)->days)/30);
								$criterioParcial = floor($criterioParcial/6);
								$criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
								$criterioTotal = floor($criterioTotal/6);
								$nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme','Presentado'));
								if($nInformesPresentados==0){
									$cumplimientoParcial = 0;
									$cumplimientoTotal = 0;
								}else{
									$cumplimientoParcial = ($nInformesPresentados/$criterioParcial)*100;
									$cumplimientoTotal = ($nInformesPresentados/$criterioTotal)*100;
								} 
                       array_push($cumplimientoMarcoParcialGraph, $cumplimientoParcial);
                       array_push($cumplimientoMarcoTotalGraph, $cumplimientoTotal);
    }
 


    $cumplimientoEspecificoParcialGraph = array();
    $cumplimientoEspecificoTotalGraph = array();
   foreach( $cumplimientoEspecifico as $convenioNivel ){
       $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
                               $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
                               $fechaAhora = date_create(date('Y-m-d'));
                               $criterioParcial = round((date_diff($fechaInicio,$fechaAhora)->days)/30);
                               $criterioParcial = floor($criterioParcial/6);
                               $criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
                               $criterioTotal = floor($criterioTotal/6);
                               $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme','Presentado'));
                               if($nInformesPresentados==0){
                                   $cumplimientoParcial = 0;
                                   $cumplimientoTotal = 0;
                               }else{
                                   $cumplimientoParcial = ($nInformesPresentados/$criterioParcial)*100;
                                   $cumplimientoTotal = ($nInformesPresentados/$criterioTotal)*100;
                               } 
                      array_push($cumplimientoEspecificoParcialGraph, $cumplimientoParcial);
                      array_push($cumplimientoEspecificoTotalGraph, $cumplimientoTotal);
   }


   $cumplimientoInternacionalParcialGraph = array();
    $cumplimientoInternacionalTotalGraph = array();
   foreach( $cumplimientoInternacional as $convenioNivel ){
       $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
                               $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
                               $fechaAhora = date_create(date('Y-m-d'));
                               $criterioParcial = round((date_diff($fechaInicio,$fechaAhora)->days)/30);
                               $criterioParcial = floor($criterioParcial/6);
                               $criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
                               $criterioTotal = floor($criterioTotal/6);
                               $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme','Presentado'));
                               if($nInformesPresentados==0){
                                   $cumplimientoParcial = 0;
                                   $cumplimientoTotal = 0;
                               }else{
                                   $cumplimientoParcial = ($nInformesPresentados/$criterioParcial)*100;
                                   $cumplimientoTotal = ($nInformesPresentados/$criterioTotal)*100;
                               } 
                      array_push($cumplimientoInternacionalParcialGraph, $cumplimientoParcial);
                      array_push($cumplimientoInternacionalTotalGraph, $cumplimientoTotal);
   }

 /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO PARCIAL*/
  $sumaMarco = 0;
  for($i=0; $i<count($cumplimientoMarcoParcialGraph);$i++){
    $sumaMarco = $sumaMarco   + $cumplimientoMarcoParcialGraph[$i];
  }
  if($sumaMarco>0){
    $cumplimientoMarcoParcial = $sumaMarco/count($cumplimientoMarcoParcialGraph) ;
  }else{
    $cumplimientoMarcoParcial  = 0;
  }

    
 /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO TOTAL*/

 $sumaMarcoTotal = 0;
 for($i=0; $i<count($cumplimientoMarcoTotalGraph);$i++){
   $sumaMarcoTotal = $sumaMarcoTotal   + $cumplimientoMarcoTotalGraph[$i];
 }
 if($sumaMarcoTotal>0){
   $cumpliminetoMarcoTotal = $sumaMarcoTotal/count($cumplimientoMarcoTotalGraph) ;
 }else{
   $cumpliminetoMarcoTotal  = 0;
 }

  /*MEDIA DE LOS CONVENIOS ESPECIFICO CUMPLIMINETO PARCIAL*/

  $sumaEspecifico = 0;
  for($i=0; $i<count($cumplimientoEspecificoParcialGraph);$i++){
    $sumaEspecifico = $sumaEspecifico    + $cumplimientoEspecificoParcialGraph[$i];
  }
  if($sumaEspecifico >0){
    $cumplimientoEspecificoParcial = $sumaEspecifico/count($cumplimientoEspecificoParcialGraph) ;
  }else{
    $cumplimientoEspecificoParcial  = 0;
  }


 /*MEDIA DE LOS CONVENIOS ESPECIFICO  CUMPLIMINETO TOTAL*/

 $sumaEspecificoTotal = 0;
  for($i=0; $i<count($cumplimientoEspecificoTotalGraph);$i++){
    $sumaEspecificoTotal = $sumaEspecificoTotal    + $cumplimientoEspecificoTotalGraph[$i];
  }
  if($sumaEspecificoTotal >0){
    $cumplimientoEspecificoTotal = $sumaEspecificoTotal /count($cumplimientoEspecificoTotalGraph) ;
  }else{
    $cumplimientoEspecificoTotal  = 0;
  }


  /*MEDIA DE LOS CONVENIOS INTERNACIONAL CUMPLIMINETO PARCIAL*/

  $sumaInternacional = 0;
  for($i=0; $i<count($cumplimientoInternacionalParcialGraph);$i++){
    $sumaInternacional = $sumaInternacional    + $cumplimientoInternacionalParcialGraph[$i];
  }
  if($sumaInternacional >0){
    $cumplimientoInternacionalParcial = $sumaInternacional/count($cumplimientoInternacionalParcialGraph) ;
  }else{
    $cumplimientoInternacionalParcial  = 0;
  }



 /*MEDIA DE LOS CONVENIOS INTERNACIONAL   CUMPLIMINETO TOTAL*/

 $sumaInternacionalTotal = 0;
 for($i=0; $i<count($cumplimientoInternacionalTotalGraph);$i++){
   $sumaInternacionalTotal= $sumaInternacionalTotal   + $cumplimientoInternacionalTotalGraph[$i];
 }
 if($sumaInternacionalTotal >0){
   $cumplimientoInternacionalTotal= $sumaInternacionalTotal/count($cumplimientoInternacionalTotalGraph) ;
 }else{
    $cumplimientoInternacionalTotal = 0;
 }


    return view('tecnico.reportes.index',compact('conveniosTotales',
    'convenioMarco',
    'convenioEspecifico',
    'convenioInternacional',
    'convenioCumplimiento',
    'cumplimientoMarcoParcial',
    'cumpliminetoMarcoTotal' ,

      'cumplimientoEspecificoParcial',
       'cumplimientoEspecificoTotal',

       'cumplimientoInternacionalParcial',
'cumplimientoInternacionalTotal'



));  
        
    }

    public function estadistica(Request $request)
    {
        $anio = $request->get('name');
        $convenioCumplimiento = Convenio::whereYear('datFechaInicioConvenio',$anio)->get();
        return redirect()->route('tecnico.reporte',$convenioCumplimiento);
    }


   
}



