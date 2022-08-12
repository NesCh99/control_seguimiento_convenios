<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpCAS;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        /**
         * Verifica si el usuario esta autenticado en el CAS y en el Sistema, para despues
         * reenviar según su rol, al inicio predeterminado para cada uno
         * Si el usuario no pertenece a los registros de usuarios de la base de datos del sistema
         * se lo reenvia al inicio de visitantes, con la información de los convenios vigentes
         */
        if(phpCAS::isAuthenticated() && Auth::check()){
            $user = Auth::user();
            $rol = $user->getRoleNames()->first();
            switch ($rol) {
                case "Administrador":
                    return redirect()->route('admin.home');
                break;
                case "Tecnico de Convenios":
                    return redirect()->route('tecnico.home');
                break;
                case "Auditor":
                    return redirect()->route('auditor.home');
                break;
            }
        }else{
            $convenios = Convenio::where('datFechaFinConvenio','<=',date('Y-m-d'));
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
                    $convenio['datFechaFinConvenio'] = 'Indeterminado';
                    $convenio['Vigencia'] = 'Indeterminado';
                }else{
                    $fecha1 = new DateTime($convenio->datFechaFinConvenio);  
                    $meses = $fecha2->diff($fecha1)->format('%r%y') * 12;
                    $vigenciaAños = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%y');
                    $vigenciaMeses = $inicio->diff(new DateTime($convenio->datFechaFinConvenio))->format('%r%m');
                    if($vigenciaMeses == 0){
                        $convenio['Vigencia'] = $vigenciaAños.' años ';
                    }else{
                        $convenio['Vigencia'] = $vigenciaAños.' años '.$vigenciaMeses. ' meses';
                    }
                }
                $convenios[$i] = $convenio;
                $i++;
            }
            return view('index', compact('convenios'));
        } 
    }
}
