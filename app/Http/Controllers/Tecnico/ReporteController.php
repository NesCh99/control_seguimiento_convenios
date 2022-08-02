<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use App\Models\Convenio;
use App\Models\Eje;
use App\Models\Resolucion;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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





        $clasificacion = Clasificacion::all();
        $eje = Eje::all();
        $clasificacion1  = $clasificacion[0]->chaNombreClasificacion;
        $clasificacion2  = $clasificacion[1]->chaNombreClasificacion;
        $clasificacion3  = $clasificacion[2]->chaNombreClasificacion;
        $eje1 =  $eje[1]->chaNombreEje;

         




        /*-*/

        /*convenios para la matriz general*/
        if (is_null($request->input('hasta')) && is_null($request->input('desde'))) {
            $conveniosTotales = Convenio::all();

            $conveniosComplimineto = Convenio::all();
        } else {
            $conveniosTotales = Convenio::whereBetween('datFechaInicioConvenio', [$request->input('desde'), $request->input('hasta')])->get();

            $conveniosComplimineto = Convenio::whereBetween('datFechaInicioConvenio', [$request->input('desde'), $request->input('hasta')])->get();
        }

        $fecha2 = new DateTime();
        $i = 0;
        foreach ($conveniosTotales as $convenio) {
            $coordinadorActual = $convenio->Coordinadores()->wherePivot('chaTipoCoordinador', 'Coordinador')->wherePivot('chaEstadoCoordinador', 'Activo')->get();
            $delegadoActual = $convenio->Coordinadores()->wherePivot('chaTipoCoordinador', 'Delegado')->wherePivot('chaEstadoCoordinador', 'Activo')->get();
            if (count($coordinadorActual) != 0) {
                $convenio['Coordinador'] = $coordinadorActual[0];
            } else {
                $convenio['Coordinador'] = null;
            }
            if (count($delegadoActual) != 0) {
                $convenio['Delegado'] = $delegadoActual[0];
            } else {
                $convenio['Delegado'] = null;
            }

            $convenio['Resolucion'] = $convenio->resolucion->chaNombreResolucion;
            $inicio = new DateTime($convenio->datFechaInicioConvenio);
            if (is_Null($convenio->datFechaFinConvenio)) {
                $estado = 'Vigente';
                $convenio['datFechaFinConvenio'] = 'Indeterminado';
                $convenio['Vigencia'] = 'Indeterminado';
            } else {
                $fecha1 = new DateTime($convenio->datFechaFinConvenio);
                $meses = $fecha2->diff($fecha1)->format('%r%y') * 12;
                if ($convenio->datFechaFinConvenio <= date('Y-m-d')) {
                    $estado = 'Caducado';
                } else if ($meses > 0) {
                    $estado = 'Vigente';
                } else if ($meses >= 0 && $meses <= 6) {
                    $estado = 'Vigente - Por Caducar';
                }
                $vigenciaAños = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%y');
                $vigenciaMeses = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%m');
                if ($vigenciaMeses == 0) {
                    $convenio['Vigencia'] = $vigenciaAños . ' años ';
                } else {
                    $convenio['Vigencia'] = $vigenciaAños . ' años ' . $vigenciaMeses . ' meses';
                }
            }
            $convenio['Estado'] = $estado;
            $conveniosTotales[$i] = $convenio;
            $i++;
        }


        $k = 0;

        foreach ($conveniosTotales as $convenio) {
            $criterioParcial = 0;
            $criterioTotal = 0;
            $cumplimientoParcial = 0;
            $cumplimientoTotal = 0;
            $informesPendientes = null;
            $informesPresentados = null;
            $fechaAhora = date_create(date('Y-m-d'));


            $informes = $convenio->Informes;

            /* Guarda todos los informes pendientes y presentados en arrays diferentes*/
            $i = 1;
            $j = 1;
            foreach ($informes as $informe) {

                if ($informe->datFechaFinInforme <= date("Y-m-d")) {
                    /* Cuenta el numero de informes que debe tener hasta la fecha de hoy el convenio */
                    $criterioParcial = $criterioParcial + 1;
                    if ($informe->chaEstadoInforme == 'Pendiente') {
                        /* Guarda en el array los informes pendientes del convenio hasta la fecha de hoy */
                        $informe['posicion'] = $i;
                        $informesPendientes[] = $informe;
                        $i = $i + 1;
                    }
                }

                if ($informe->chaEstadoInforme == 'Presentado') {
                    $informe['posicion'] = $j;
                    $informesPresentados[] = $informe;
                    $j = $j + 1;
                }
            }

            /* Cuenta el numero de informes que debe tener en total el convenio */
            $criterioTotal = count($informes);

            if (is_null($informesPresentados) == false) {
                /* Calcula el número de informes presentados sobre criterio parcial */
                $cumplimientoParcial = floor((count($informesPresentados) / $criterioParcial) * 100);

                /* Calcula el número de informes presentados sobre criterio total*/
                $cumplimientoTotal = floor((count($informesPresentados) / $criterioTotal) * 100);
            }

            /* Asigna las variables al objeto convenio para presentar en la vista */

            $convenio['criterioParcial'] = $criterioParcial;
            $convenio['criterioTotal'] = $criterioTotal;
            $convenio['cumplimientoParcial'] = $cumplimientoParcial;
            $convenio['cumplimientoTotal'] = $cumplimientoTotal;
            $conveniosTotales[$k] = $convenio;

            $k++;
        }

        $vigencia = $request->input('Años');

        $conveniosVigentes = array();
        $stadoVigencia = 'Vigente';
        $stadoPorCaducador =  'Vigente - Por Caducar';
        $indeterminado = 'Indeterminado';

        if (is_null($request->input('Años'))) {
            foreach ($conveniosTotales as $convenioVigente) {
                if ($convenioVigente->Estado == $stadoVigencia || $convenioVigente->Estado == $stadoPorCaducador || $convenioVigente->Estado == $indeterminado) {

                    array_push($conveniosVigentes, $convenioVigente);
                }
            }
        } else {
            foreach ($conveniosTotales as $convenioVigente) {
                if ($convenioVigente->Estado == $stadoVigencia || $convenioVigente->Estado == $stadoPorCaducador || $convenioVigente->Estado == $indeterminado) {
                    $fecha = substr($convenioVigente->datFechaInicioConvenio, 0, 4);
                    if ($fecha == $vigencia) {
                        array_push($conveniosVigentes, $convenioVigente);
                    }
                }
            }
        }

        $convenioMarco = array();

        $convenioEspecifico = array();
        $convenioEspecificoPracticas = array();
        $convenioInternacional = array();

        /*convenios vigentes para el grafico */
        foreach ($conveniosVigentes as $vigente) {
            $idClasificacion = $vigente->idClasificacion;


            if ($idClasificacion == 1) {
                array_push($convenioMarco, $vigente);
            }

            if ($idClasificacion == 2) {
                array_push($convenioEspecifico, $vigente);

                foreach ($vigente->Ejes as $eje) {
                    $practicas = $eje->idEje;
                    if ($practicas  == 2) {
                        array_push($convenioEspecificoPracticas, $vigente);
                    }
                }
            }

            if ($idClasificacion == 3) {
                array_push($convenioInternacional, $vigente);
            }
        }

















        /*media de cumplimiento parcial Convenios Vigentes clasificacion Marco  */
        $convenioMarcoCP = array();
        foreach ($convenioMarco as $marco) {

            $cumplimientoParcial = $marco->cumplimientoParcial;

            array_push($convenioMarcoCP, $cumplimientoParcial);
        }
        $sumaMarco = 0;
        for ($cp = 0; $cp < count($convenioMarcoCP); $cp++) {
            $sumaMarco = $sumaMarco + $convenioMarcoCP[$cp];
        }

        if ($sumaMarco > 0) {

            $vigenciaConveniosMarcos = $sumaMarco / count($convenioMarcoCP);
        } else {
            $vigenciaConveniosMarcos = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioMarcoCT = array();
        foreach ($convenioMarco as $marco) {

            $cumplimientoTotal = $marco->cumplimientoTotal;

            array_push($convenioMarcoCT, $cumplimientoTotal);
        }
        $sumaMarcoTotal = 0;
        for ($cp = 0; $cp < count($convenioMarcoCT); $cp++) {
            $sumaMarcoTotal = $sumaMarcoTotal + $convenioMarcoCT[$cp];
        }

        if ($sumaMarcoTotal > 0) {

            $vigenciaConveniosMarcosTotal = $sumaMarcoTotal / count($convenioMarcoCT);
        } else {
            $vigenciaConveniosMarcosTotal = 0;
        }




        /*media de cumplimiento parcial Convenios Vigentes clasificacion Especifico */
        $convenioEspecificoCP = array();
        foreach ($convenioEspecifico as $especifico) {

            $cumplimientoParcial = $especifico->cumplimientoParcial;

            array_push($convenioEspecificoCP, $cumplimientoParcial);
        }
        $sumaEspecifico = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCP); $cp++) {
            $sumaEspecifico = $sumaEspecifico + $convenioEspecificoCP[$cp];
        }

        if ($sumaEspecifico > 0) {

            $vigenciaConveniosEspecificos = $sumaEspecifico / count($convenioEspecificoCP);
        } else {
            $vigenciaConveniosEspecificos = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioEspecificoCT = array();
        foreach ($convenioEspecifico as $especifico) {

            $cumplimientoTotal = $especifico->cumplimientoTotal;

            array_push($convenioEspecificoCT, $cumplimientoTotal);
        }

        $sumaEspecificoTotal = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCT); $cp++) {
            $sumaEspecificoTotal = $sumaEspecificoTotal + $convenioEspecificoCT[$cp];
        }

        if ($sumaEspecificoTotal > 0) {

            $vigenciaConveniosEspecificosTotal = $sumaEspecificoTotal / count($convenioEspecificoCT);
        } else {
            $vigenciaConveniosEspecificosTotal = 0;
        }

















        $convenioEspecificoPracticasCP = array();
        foreach ($convenioEspecificoPracticas as $especifico) {

            $cumplimientoParcial = $especifico->cumplimientoParcial;

            array_push($convenioEspecificoPracticasCP, $cumplimientoParcial);
        }
        $sumaEspecificoPracticas = 0;
        for ($cp = 0; $cp < count($convenioEspecificoPracticasCP); $cp++) {
            $sumaEspecificoPracticas = $sumaEspecificoPracticas + $convenioEspecificoPracticasCP[$cp];
        }

        if ($sumaEspecificoPracticas > 0) {

            $vigenciaConveniosEspecificosPracticas = $sumaEspecificoPracticas / count($convenioEspecificoPracticasCP);
        } else {
            $vigenciaConveniosEspecificosPracticas = 0;
        }




        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioEspecificoPracticasCT = array();
        foreach ($convenioEspecificoPracticas as $especifico) {

            $cumplimientoTotal = $especifico->cumplimientoTotal;

            array_push($convenioEspecificoPracticasCT, $cumplimientoTotal);
        }

        $sumaEspecificoTotalPracticas = 0;
        for ($cp = 0; $cp < count($convenioEspecificoPracticasCT); $cp++) {
            $sumaEspecificoTotalPracticas  = $sumaEspecificoTotalPracticas  + $convenioEspecificoPracticasCT[$cp];
        }

        if ($sumaEspecificoTotalPracticas  > 0) {

            $vigenciaConveniosEspecificosTotalPracticas = $sumaEspecificoTotalPracticas  / count($convenioEspecificoPracticasCT);
        } else {
            $vigenciaConveniosEspecificosTotalPracticas = 0;
        }

































        /*media de cumplimiento parcial Convenios Vigentes clasificacion Internacional*/
        $convenioInternacionalCP = array();
        foreach ($convenioInternacional as $internacional) {

            $cumplimientoParcial = $internacional->cumplimientoParcial;

            array_push($convenioInternacionalCP, $cumplimientoParcial);
        }
        $sumaInternacional = 0;
        for ($cp = 0; $cp < count($convenioInternacionalCP); $cp++) {
            $sumaInternacional = $sumaInternacional + $convenioInternacionalCP[$cp];
        }

        if ($sumaInternacional > 0) {

            $vigenciaConveniosInternacionales = $sumaInternacional / count($convenioInternacionalCP);
        } else {
            $vigenciaConveniosInternacionales = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Inernacional  */
        $convenioInternacionalCT = array();
        foreach ($convenioInternacional as $internacional) {

            $cumplimientoTotal = $internacional->cumplimientoTotal;

            array_push($convenioInternacionalCT, $cumplimientoTotal);
        }
        $sumaInternacionalTotal = 0;
        for ($cp = 0; $cp < count($convenioInternacionalCT); $cp++) {
            $sumaInternacionalTotal = $sumaInternacionalTotal + $convenioInternacionalCT[$cp];
        }

        if ($sumaInternacionalTotal > 0) {

            $vigenciaConveniosInternacionalesTotal = $sumaInternacionalTotal / count($convenioInternacionalCT);
        } else {
            $vigenciaConveniosInternacionalesTotal = 0;
        }

        /*CONVENIOS CADUCADOS  */

        $caducados = $request->input('caducados');

        $estadoCaducado = 'Caducado';

        $conveniosCaducados = array();
        if (is_null($request->input('caducados'))) {
            foreach ($conveniosTotales as $convenioCaducado) {
                if ($convenioCaducado->Estado  == $estadoCaducado) {

                    array_push($conveniosCaducados, $convenioCaducado);
                }
            }
        } else {
            foreach ($conveniosTotales as $convenioCaducad) {
                if ($convenioCaducad->Estado == $estadoCaducado) {
                    $fecha = substr($convenioCaducad->datFechaFinConvenio, 0, 4);
                    if ($fecha == $caducados) {
                        array_push($conveniosCaducados, $convenioCaducad);
                    }
                }
            }
        }



        $convenioMarcoCaducado = array();
        $convenioEspecificoCaducado = array();
        $convenioEspecificoCaducadoPracticas = array();
        $convenioInternacionalCaducado = array();

        /*convenios vigentes para el grafico */
        foreach ($conveniosCaducados as $caducado) {
            $idClasificacion = $caducado->idClasificacion;

            if ($idClasificacion == 1) {

                array_push($convenioMarcoCaducado, $caducado);
            }

            if ($idClasificacion == 2) {
                array_push($convenioEspecificoCaducado, $caducado);

                foreach ($caducado->Ejes as $eje) {
                    $practicas = $eje->idEje;
                    if ($practicas  == 2) {
                        array_push($convenioEspecificoCaducadoPracticas, $caducado);
                    }
                }
            }

            if ($idClasificacion == 3) {
                array_push($convenioInternacionalCaducado, $caducado);
            }
        }














        /*media de cumplimiento parcial Convenios Vigentes clasificacion Marco  */
        $convenioMarcoCPCaducado = array();
        foreach ($convenioMarcoCaducado as $marco) {

            $cumplimientoParcial = $marco->cumplimientoParcial;

            array_push($convenioMarcoCPCaducado, $cumplimientoParcial);
        }
        $sumaMarcoCaducado = 0;
        for ($cp = 0; $cp < count($convenioMarcoCPCaducado); $cp++) {
            $sumaMarcoCaducado = $sumaMarcoCaducado + $convenioMarcoCPCaducado[$cp];
        }

        if ($sumaMarcoCaducado  > 0) {

            $vigenciaConveniosMarcosCaducado = $sumaMarcoCaducado / count($convenioMarcoCPCaducado);
        } else {
            $vigenciaConveniosMarcosCaducado = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioMarcoCTCaducado = array();
        foreach ($convenioMarcoCaducado as $marco) {

            $cumplimientoTotal = $marco->cumplimientoTotal;

            array_push($convenioMarcoCTCaducado, $cumplimientoTotal);
        }
        $sumaMarcoTotalCaducado = 0;
        for ($cp = 0; $cp < count($convenioMarcoCTCaducado); $cp++) {
            $sumaMarcoTotalCaducado = $sumaMarcoTotalCaducado + $convenioMarcoCTCaducado[$cp];
        }

        if ($sumaMarcoTotalCaducado > 0) {

            $vigenciaConveniosMarcosTotalCaducado = $sumaMarcoTotalCaducado / count($convenioMarcoCTCaducado);
        } else {
            $vigenciaConveniosMarcosTotalCaducado  = 0;
        }




        /*media de cumplimiento parcial Convenios Vigentes clasificacion Especifico */
        $convenioEspecificoCPCaducado = array();
        foreach ($convenioEspecificoCaducado as $especifico) {

            $cumplimientoParcial = $especifico->cumplimientoParcial;

            array_push($convenioEspecificoCPCaducado, $cumplimientoParcial);
        }
        $sumaEspecificoCaducado = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCPCaducado); $cp++) {
            $sumaEspecificoCaducado  = $sumaEspecificoCaducado + $convenioEspecificoCPCaducado[$cp];
        }

        if ($sumaEspecificoCaducado  > 0) {

            $vigenciaConveniosEspecificosCaducado =  $sumaEspecificoCaducado  / count($convenioEspecificoCPCaducado);
        } else {
            $vigenciaConveniosEspecificosCaducado = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioEspecificoCTCaducado = array();
        foreach ($convenioEspecificoCaducado as $especifico) {

            $cumplimientoTotal = $especifico->cumplimientoTotal;

            array_push($convenioEspecificoCTCaducado, $cumplimientoTotal);
        }




        $sumaEspecificoTotalCaducado = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCTCaducado); $cp++) {
            $sumaEspecificoTotalCaducado = $sumaEspecificoTotalCaducado + $convenioEspecificoCTCaducado[$cp];
        }

        if ($sumaEspecificoTotalCaducado > 0) {

            $vigenciaConveniosEspecificosTotalCaducado = $sumaEspecificoTotalCaducado / count($convenioEspecificoCTCaducado);
        } else {
            $vigenciaConveniosEspecificosTotalCaducado = 0;
        }
















        /*PLANIF */

        /*media de cumplimiento parcial Convenios Vigentes clasificacion Especifico */
        $convenioEspecificoCPCaducadoPracticas = array();
        foreach ($convenioEspecificoCaducadoPracticas as $especifico) {

            $cumplimientoParcial = $especifico->cumplimientoParcial;

            array_push($convenioEspecificoCPCaducadoPracticas, $cumplimientoParcial);
        }
        $sumaEspecificoCaducadoPracticas = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCPCaducadoPracticas); $cp++) {
            $sumaEspecificoCaducadoPracticas  = $sumaEspecificoCaducadoPracticas +  $convenioEspecificoCPCaducadoPracticas[$cp];
        }

        if ($sumaEspecificoCaducadoPracticas  > 0) {

            $vigenciaConveniosEspecificosCaducadoPracticas =  $sumaEspecificoCaducadoPracticas  / count($convenioEspecificoCPCaducadoPracticas);
        } else {
            $vigenciaConveniosEspecificosCaducadoPracticas = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Marco  */
        $convenioEspecificoCTCaducadoPracticas = array();
        foreach ($convenioEspecificoCaducadoPracticas as $especifico) {

            $cumplimientoTotal = $especifico->cumplimientoTotal;

            array_push($convenioEspecificoCTCaducadoPracticas, $cumplimientoTotal);
        }




        $sumaEspecificoTotalCaducadoPracticas = 0;
        for ($cp = 0; $cp < count($convenioEspecificoCTCaducadoPracticas); $cp++) {
            $sumaEspecificoTotalCaducadoPracticas =  $sumaEspecificoTotalCaducadoPracticas + $convenioEspecificoCTCaducadoPracticas[$cp];
        }

        if ($sumaEspecificoTotalCaducadoPracticas > 0) {

            $vigenciaConveniosEspecificosTotalCaducadoPracticas =  $sumaEspecificoTotalCaducadoPracticas / count($convenioEspecificoCTCaducadoPracticas);
        } else {
            $vigenciaConveniosEspecificosTotalCaducadoPracticas = 0;
        }




        /* FIN PALNI */




























































        /*media de cumplimiento parcial Convenios Vigentes clasificacion Internacional*/
        $convenioInternacionalCPCaducado = array();
        foreach ($convenioInternacionalCaducado as $internacional) {

            $cumplimientoParcial = $internacional->cumplimientoParcial;

            array_push($convenioInternacionalCPCaducado, $cumplimientoParcial);
        }
        $sumaInternacionalCaducado = 0;
        for ($cp = 0; $cp < count($convenioInternacionalCPCaducado); $cp++) {
            $sumaInternacionalCaducado = $sumaInternacionalCaducado + $convenioInternacionalCPCaducado[$cp];
        }

        if ($sumaInternacionalCaducado > 0) {

            $vigenciaConveniosInternacionalesCaducado = $sumaInternacionalCaducado / count($convenioInternacionalCPCaducado);
        } else {
            $vigenciaConveniosInternacionalesCaducado = 0;
        }

        /*media de cumplimiento Total  Vigentes clasificacion Inernacional  */
        $convenioInternacionalCTCaducado = array();
        foreach ($convenioInternacionalCaducado as $internacional) {

            $cumplimientoTotal = $internacional->cumplimientoTotal;

            array_push($convenioInternacionalCTCaducado, $cumplimientoTotal);
        }
        $sumaInternacionalTotalCaducado = 0;
        for ($cp = 0; $cp < count($convenioInternacionalCTCaducado); $cp++) {
            $sumaInternacionalTotalCaducado  = $sumaInternacionalTotalCaducado  + $convenioInternacionalCTCaducado[$cp];
        }

        if ($sumaInternacionalTotalCaducado  > 0) {

            $vigenciaConveniosInternacionalesTotalCaducado = $sumaInternacionalTotalCaducado  / count($convenioInternacionalCTCaducado);
        } else {
            $vigenciaConveniosInternacionalesTotalCaducado = 0;
        }












        return view('tecnico.reportes.index', compact(
            'conveniosTotales',
            'conveniosComplimineto',

            'fechaVigenteMin',
            'fechaVigenteMax',
            'fechaCaducadoMin',
            'fechaCaducadoMax',
            'clasificacion1',
            'clasificacion2',
            'clasificacion3',
            'eje1',

            'vigencia',
            'convenioEspecificoPracticas',

            'convenioMarco',
            'convenioEspecifico',
            'convenioInternacional',

            'vigenciaConveniosMarcos',
            'vigenciaConveniosMarcosTotal',

            'vigenciaConveniosEspecificos',
            'vigenciaConveniosEspecificosTotal',

            'vigenciaConveniosEspecificosPracticas',
            'vigenciaConveniosEspecificosTotalPracticas',



            'vigenciaConveniosInternacionales',
            'vigenciaConveniosInternacionalesTotal',

            'caducados',
            'convenioEspecificoCaducadoPracticas',
            'convenioMarcoCaducado',
            'convenioEspecificoCaducado',
            'convenioInternacionalCaducado',

            'vigenciaConveniosMarcosCaducado',
            'vigenciaConveniosMarcosTotalCaducado',

            'vigenciaConveniosEspecificosCaducado',
            'vigenciaConveniosEspecificosTotalCaducado',
            'vigenciaConveniosEspecificosCaducadoPracticas',
            'vigenciaConveniosEspecificosTotalCaducadoPracticas',

            'vigenciaConveniosInternacionalesCaducado',
            'vigenciaConveniosInternacionalesTotalCaducado'

        ));
    }
}
