<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eje;
use DateTime;
use Illuminate\Http\Request;

class EjeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.ejes.index')->only('index');
        $this->middleware('can:admin.ejes.create')->only('create');
        $this->middleware('can:admin.ejes.edit')->only('edit');
        $this->middleware('can:admin.ejes.show')->only('show');
        $this->middleware('can:admin.ejes.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejes = Eje::all();
        return view('admin.ejes.index', compact('ejes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ejes.create');
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
            'Nombre'=>'required|unique:v_ejes,chaNombreEje'
        ]);
        
        $eje = Eje::create([
            'chaNombreEje' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.ejes.index', $eje)->with('info', $eje->chaNombreEje.' ha sido registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idEje)
    {
        $eje = Eje::find($idEje);
        $convenios = $eje->convenios;
        $band = $eje->chaNombreEje;
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
        return view('tecnico.convenios.index', compact('convenios', 'band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idEje)
    {
        $eje = Eje::find($idEje);
        return view('admin.ejes.edit', compact('eje'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEje)
    {
        $eje = Eje::find($idEje);
        $request->validate([
            'Nombre'=>"required|unique:v_ejes,chaNombreEje,$eje->idEje,idEje",
        ]);

        $eje->update([
            'chaNombreEje' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.ejes.index', $eje)->with('info', $eje->chaNombreEje.' ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEje)
    {
        $eje = Eje::findOrFail($idEje);
        $eje->delete();
        return redirect()->route('admin.ejes.index')->with('info',$eje->chaNombreEje.' ha sido eliminado con éxito');
    }
}
