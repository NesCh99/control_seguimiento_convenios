<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use App\Models\Convenio;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*recuperar fechas para los filtros */
        $fechaConveniosVigentes = Convenio::select('datFechaInicioConvenio')->get();
        $fechaVigenteMin = $fechaConveniosVigentes->min('datFechaInicioConvenio');
        $fechaVigenteMax = $fechaConveniosVigentes->max('datFechaInicioConvenio');

        $fechaVigenteMin = substr($fechaVigenteMin, 0, 4);
        $fechaVigenteMax = substr($fechaVigenteMax, 0, 4);

        $fechaConveniosCaducados = Convenio::select('datFechaFinConvenio')->get();
        $fechaCaducadoMin = $fechaConveniosCaducados->min('datFechaFinConvenio');
        $fechaCaducadoMax = $fechaConveniosCaducados->max('datFechaFinConvenio');

        $fechaCaducadoMin = substr($fechaCaducadoMin, 0, 4);
        $fechaCaducadoMax = substr($fechaCaducadoMax, 0, 4);
        /*-*/

        /*convenios para la matriz general*/
        if (is_null($request->input('hasta')) && is_null($request->input('desde')) ){
            $conveniosTotales = Convenio::all();
        }else{
            $conveniosTotales = Convenio::whereBetween('datFechaInicioConvenio', [$request->input('desde'), $request->input('hasta')])->get();
        }
      

        
        $clasificacion = Clasificacion::all();
        /*fin convenios para la matriz general*/

        $fechaAhora = date_create(date('Y-m-d'));

        /*convenios vigentes para el grafico */
        $vigencia = $request->input('Años');

        if (is_null($request->input('Años'))) {
            $conveniosVigentes = Convenio::where('datFechaFinConvenio', '>=', $fechaAhora)->get();

        } else {
            $conveniosVigentes = Convenio::where('datFechaFinConvenio', '>=', $fechaAhora)
                ->whereYear('datFechaInicioConvenio', $request->input('Años'))->get();

        }

        $convenioMarco = $conveniosVigentes->where('idClasificacion', '1');
        $convenioEspecifico = $conveniosVigentes->where('idClasificacion', '2');
        $convenioInternacional = $conveniosVigentes->where('idClasificacion', '3');

        /*convenios caducados para el grafico */

        $caducado = $request->input('caducado');

        if (is_null($request->input('caducado'))) {
            $conveniosCaducados = Convenio::where('datFechaFinConvenio', '<=', $fechaAhora)->get();

        } else {
            $conveniosCaducados = Convenio::where('datFechaFinConvenio', '<=', $fechaAhora)
                ->whereYear('datFechaFinConvenio', $request->input('caducado'))->get();

        }

        $convenioMarcoCaducado = $conveniosCaducados->where('idClasificacion', '1');
        $convenioEspecificoCaducado = $conveniosCaducados->where('idClasificacion', '2');
        $convenioInternacionalCaducado = $conveniosCaducados->where('idClasificacion', '3');
        /* fin convenios caducados para el grafico */

        /*cumplimineto vigente */

        if (is_null($request->input('Años'))) {

            $convenioCumplimiento = Convenio::where('datFechaFinConvenio', '>=', $fechaAhora)->get();
        } else {
            $convenioCumplimiento = Convenio::whereYear('datFechaInicioConvenio', $request->input('Año'))->get();
        }

        $cumplimientoMarco = $convenioCumplimiento->where('idClasificacion', '1');
        $cumplimientoEspecifico = $convenioCumplimiento->where('idClasificacion', '2');
        $cumplimientoInternacional = $convenioCumplimiento->where('idClasificacion', '3');

        $cumplimientoMarcoParcialGraph = array();
        $cumplimientoMarcoTotalGraph = array();
        foreach ($cumplimientoMarco as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoMarcoParcialGraph, $cumplimientoParcial);
            array_push($cumplimientoMarcoTotalGraph, $cumplimientoTotal);
        }

        $cumplimientoEspecificoParcialGraph = array();
        $cumplimientoEspecificoTotalGraph = array();
        foreach ($cumplimientoEspecifico as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoEspecificoParcialGraph, $cumplimientoParcial);
            array_push($cumplimientoEspecificoTotalGraph, $cumplimientoTotal);
        }

        $cumplimientoInternacionalParcialGraph = array();
        $cumplimientoInternacionalTotalGraph = array();
        foreach ($cumplimientoInternacional as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoInternacionalParcialGraph, $cumplimientoParcial);
            array_push($cumplimientoInternacionalTotalGraph, $cumplimientoTotal);
        }

        /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO PARCIAL*/
        $sumaMarco = 0;
        for ($i = 0; $i < count($cumplimientoMarcoParcialGraph); $i++) {
            $sumaMarco = $sumaMarco + $cumplimientoMarcoParcialGraph[$i];
        }
        if ($sumaMarco > 0) {
            $cumplimientoMarcoParcial = $sumaMarco / count($cumplimientoMarcoParcialGraph);
        } else {
            $cumplimientoMarcoParcial = 0;
        }

        /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO TOTAL*/

        $sumaMarcoTotal = 0;
        for ($i = 0; $i < count($cumplimientoMarcoTotalGraph); $i++) {
            $sumaMarcoTotal = $sumaMarcoTotal + $cumplimientoMarcoTotalGraph[$i];
        }
        if ($sumaMarcoTotal > 0) {
            $cumpliminetoMarcoTotal = $sumaMarcoTotal / count($cumplimientoMarcoTotalGraph);
        } else {
            $cumpliminetoMarcoTotal = 0;
        }

        /*MEDIA DE LOS CONVENIOS ESPECIFICO CUMPLIMINETO PARCIAL*/

        $sumaEspecifico = 0;
        for ($i = 0; $i < count($cumplimientoEspecificoParcialGraph); $i++) {
            $sumaEspecifico = $sumaEspecifico + $cumplimientoEspecificoParcialGraph[$i];
        }
        if ($sumaEspecifico > 0) {
            $cumplimientoEspecificoParcial = $sumaEspecifico / count($cumplimientoEspecificoParcialGraph);
        } else {
            $cumplimientoEspecificoParcial = 0;
        }

        /*MEDIA DE LOS CONVENIOS ESPECIFICO  CUMPLIMINETO TOTAL*/

        $sumaEspecificoTotal = 0;
        for ($i = 0; $i < count($cumplimientoEspecificoTotalGraph); $i++) {
            $sumaEspecificoTotal = $sumaEspecificoTotal + $cumplimientoEspecificoTotalGraph[$i];
        }
        if ($sumaEspecificoTotal > 0) {
            $cumplimientoEspecificoTotal = $sumaEspecificoTotal / count($cumplimientoEspecificoTotalGraph);
        } else {
            $cumplimientoEspecificoTotal = 0;
        }

        /*MEDIA DE LOS CONVENIOS INTERNACIONAL CUMPLIMINETO PARCIAL*/

        $sumaInternacional = 0;
        for ($i = 0; $i < count($cumplimientoInternacionalParcialGraph); $i++) {
            $sumaInternacional = $sumaInternacional + $cumplimientoInternacionalParcialGraph[$i];
        }
        if ($sumaInternacional > 0) {
            $cumplimientoInternacionalParcial = $sumaInternacional / count($cumplimientoInternacionalParcialGraph);
        } else {
            $cumplimientoInternacionalParcial = 0;
        }

        /*MEDIA DE LOS CONVENIOS INTERNACIONAL   CUMPLIMINETO TOTAL*/

        $sumaInternacionalTotal = 0;
        for ($i = 0; $i < count($cumplimientoInternacionalTotalGraph); $i++) {
            $sumaInternacionalTotal = $sumaInternacionalTotal + $cumplimientoInternacionalTotalGraph[$i];
        }
        if ($sumaInternacionalTotal > 0) {
            $cumplimientoInternacionalTotal = $sumaInternacionalTotal / count($cumplimientoInternacionalTotalGraph);
        } else {
            $cumplimientoInternacionalTotal = 0;
        }

        /*cumplimineto caducado*/

        if (is_null($request->input('caducado'))) {

            $convenioCumplimientoCaducado = Convenio::where('datFechaFinConvenio', '<=', $fechaAhora)->get();
        } else {
            $convenioCumplimientoCaducado = Convenio::whereYear('datFechaFinConvenio', $request->input('Año'))->get();
        }

        $cumplimientoMarcoCaducado = $convenioCumplimientoCaducado->where('idClasificacion', '1');
        $cumplimientoEspecificoCaducado = $convenioCumplimientoCaducado->where('idClasificacion', '2');
        $cumplimientoInternacionalCaducado = $convenioCumplimientoCaducado->where('idClasificacion', '3');

        $cumplimientoMarcoParcialCaducadoGraph = array();
        $cumplimientoMarcoTotalCaducadoGraph = array();
        foreach ($cumplimientoMarcoCaducado as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoMarcoParcialCaducadoGraph, $cumplimientoParcial);
            array_push($cumplimientoMarcoTotalCaducadoGraph, $cumplimientoTotal);
        }

        $cumplimientoEspecificoParcialCaducadoGraph = array();
        $cumplimientoEspecificoTotalCaducadoGraph = array();
        foreach ($cumplimientoEspecificoCaducado as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoEspecificoParcialCaducadoGraph, $cumplimientoParcial);
            array_push($cumplimientoEspecificoTotalCaducadoGraph, $cumplimientoTotal);
        }

        $cumplimientoInternacionalParcialCaducadoGraph = array();
        $cumplimientoInternacionalTotalCaducadoGraph = array();
        foreach ($cumplimientoInternacionalCaducado as $convenioNivel) {
            $fechaInicio = date_create($convenioNivel->datFechaInicioConvenio);
            $fechaFin = date_create($convenioNivel->datFechaFinConvenio);
            $fechaAhora = date_create(date('Y-m-d'));
            $criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
            $criterioParcial = floor($criterioParcial / 6);
            $criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
            $criterioTotal = floor($criterioTotal / 6);
            $nInformesPresentados = count($convenioNivel->informes->where('chaEstadoInforme', 'Presentado'));
            if ($nInformesPresentados == 0) {
                $cumplimientoParcial = 0;
                $cumplimientoTotal = 0;
            } else {
                $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
                $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
            }
            array_push($cumplimientoInternacionalParcialCaducadoGraph, $cumplimientoParcial);
            array_push($cumplimientoInternacionalTotalCaducadoGraph, $cumplimientoTotal);
        }

        /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO PARCIAL*/
        $sumaMarcoCaducado = 0;
        for ($i = 0; $i < count($cumplimientoMarcoParcialCaducadoGraph); $i++) {
            $sumaMarcoCaducado = $sumaMarcoCaducado + $cumplimientoMarcoParcialCaducadoGraph[$i];
        }
        if ($sumaMarcoCaducado > 0) {
            $cumplimientoMarcoParcialCaducado = $sumaMarcoCaducado / count($cumplimientoMarcoParcialCaducadoGraph);
        } else {
            $cumplimientoMarcoParcialCaducado = 0;
        }

        /*MEDIA DE LOS CONVENIOS MARCO CUMPLIMINETO TOTAL*/

        $sumaMarcoTotalCaducado = 0;
        for ($i = 0; $i < count($cumplimientoMarcoTotalCaducadoGraph); $i++) {
            $sumaMarcoTotalCaducado = $sumaMarcoTotalCaducado + $cumplimientoMarcoTotalCaducadoGraph[$i];
        }
        if ($sumaMarcoTotalCaducado > 0) {
            $cumpliminetoMarcoTotalCaducado = $sumaMarcoTotalCaducado / count($cumplimientoMarcoTotalCaducadoGraph);
        } else {
            $cumpliminetoMarcoTotalCaducado = 0;
        }

        /*MEDIA DE LOS CONVENIOS ESPECIFICO CUMPLIMINETO PARCIAL*/

        $sumaEspecificoCaducado = 0;
        for ($i = 0; $i < count($cumplimientoEspecificoParcialCaducadoGraph); $i++) {
            $sumaEspecificoCaducado = $sumaEspecificoCaducado + $cumplimientoEspecificoParcialCaducadoGraph[$i];
        }
        if ($sumaEspecificoCaducado > 0) {
            $cumplimientoEspecificoParcialCaducado = $sumaEspecificoCaducado / count($cumplimientoEspecificoParcialCaducadoGraph);
        } else {
            $cumplimientoEspecificoParcialCaducado = 0;
        }

        /*MEDIA DE LOS CONVENIOS ESPECIFICO  CUMPLIMINETO TOTAL*/

        $sumaEspecificoTotalCaducado = 0;
        for ($i = 0; $i < count($cumplimientoEspecificoTotalCaducadoGraph); $i++) {
            $sumaEspecificoTotalCaducado = $sumaEspecificoTotalCaducado + $cumplimientoEspecificoTotalCaducadoGraph[$i];
        }
        if ($sumaEspecificoTotalCaducado > 0) {
            $cumplimientoEspecificoTotalCaducado = $sumaEspecificoTotalCaducado / count($cumplimientoEspecificoTotalCaducadoGraph);
        } else {
            $cumplimientoEspecificoTotalCaducado = 0;
        }

        /*MEDIA DE LOS CONVENIOS INTERNACIONAL CUMPLIMINETO PARCIAL*/

        $sumaInternacionalCaducado = 0;
        for ($i = 0; $i < count($cumplimientoInternacionalParcialCaducadoGraph); $i++) {
            $sumaInternacionalCaducado = $sumaInternacionalCaducado + $cumplimientoInternacionalParcialCaducadoGraph[$i];
        }
        if ($sumaInternacionalCaducado > 0) {
            $cumplimientoInternacionalParcialCaducado = $sumaInternacionalCaducado / count($cumplimientoInternacionalParcialCaducadoGraph);
        } else {
            $cumplimientoInternacionalParcialCaducado = 0;
        }

        /*MEDIA DE LOS CONVENIOS INTERNACIONAL   CUMPLIMINETO TOTAL*/

        $sumaInternacionalTotalCaducado = 0;
        for ($i = 0; $i < count($cumplimientoInternacionalTotalCaducadoGraph); $i++) {
            $sumaInternacionalTotalCaducado = $sumaInternacionalTotalCaducado + $cumplimientoInternacionalTotalCaducadoGraph[$i];
        }
        if ($sumaInternacionalTotalCaducado > 0) {
            $cumplimientoInternacionalTotalCaducado = $sumaInternacionalTotalCaducado / count($cumplimientoInternacionalTotalCaducadoGraph);
        } else {
            $cumplimientoInternacionalTotalCaducado = 0;
        }

        return view('tecnico.reportes.index', compact('conveniosTotales',

            'fechaVigenteMin',
            'fechaVigenteMax',
            'fechaCaducadoMin',
            'fechaCaducadoMax',

            'vigencia',
            'convenioMarco',
            'convenioEspecifico',
            'convenioInternacional',

            'caducado',
            'convenioMarcoCaducado',
            'convenioEspecificoCaducado',
            'convenioInternacionalCaducado',

            'convenioCumplimiento',

            'cumplimientoMarcoParcial',
            'cumpliminetoMarcoTotal',

            'cumplimientoEspecificoParcial',
            'cumplimientoEspecificoTotal',

            'cumplimientoInternacionalParcial',
            'cumplimientoInternacionalTotal',

            'cumplimientoMarcoParcialCaducado',
            'cumpliminetoMarcoTotalCaducado',

            'cumplimientoEspecificoParcialCaducado',
            'cumplimientoEspecificoTotalCaducado',

            'cumplimientoInternacionalParcialCaducado',
            'cumplimientoInternacionalTotalCaducado'

        ));

    }

}
