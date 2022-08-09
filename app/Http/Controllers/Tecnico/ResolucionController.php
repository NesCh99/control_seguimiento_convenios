<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Convenio;
use App\Models\Coordinador;
use App\Models\Resolucion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ResolucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tecnico.resoluciones.index')->only('index');
        $this->middleware('can:tecnico.resoluciones.create')->only('create');
        $this->middleware('can:tecnico.resoluciones.edit')->only('edit');
        $this->middleware('can:tecnico.resoluciones.show')->only('show');
        $this->middleware('can:tecnico.resoluciones.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resoluciones = Resolucion::all();
        return view('tecnico.resoluciones.index', compact('resoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tecnico.resoluciones.create');
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
            'Nombre' => 'required|string|max:30|unique:v_resoluciones,chaNombreResolucion',
        ]);        

        $resolucion = Resolucion::create([
            'chaNombreResolucion' => strtoupper($request->input('Nombre')),
            'sinTipoResolucion' => $request->input('Tipo')
        ]);

        return redirect()->route('tecnico.resoluciones.index', $resolucion)->with('info', $resolucion->chaNombreResolucion .' ha sido registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resolucion = Resolucion::find($id);
        return view('tecnico.resoluciones.show', compact('resolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resolucion = Resolucion::find($id);
        return view('tecnico.resoluciones.edit', compact('resolucion'));
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
        $resolucion = Resolucion::find($id);
        $request->validate([
            'Nombre' => "required|string|max:25|unique:v_resoluciones,chaNombreResolucion,$resolucion->idResolucion,idResolucion",
        ]);
        $resolucion ->update([
            'chaNombreResolucion' => strtoupper($request->input('Nombre')),
            'sinTipoResolucion' => $request->input('Tipo'),
        ]);

        return redirect()->route('tecnico.resoluciones.index', $resolucion)->with('info', $resolucion->chaNombreResolucion .' ha sido actualizado con éxito');
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
    /**
     * Agrega un coordinador a una resolucion
     *
     */

    public function asignarCoordinador(Request $request, $idCoordinador){
        $coordinador = Coordinador::find($idCoordinador);
        $request->validate([
            'Resolucion' => 'required|exists:v_resoluciones,chaNombreResolucion'
        ]);
        $nombre = $request->input('Resolucion');
        $id = Resolucion::select('idResolucion')->where('chaNombreResolucion','=',$nombre)->get()
        ->pluck('idResolucion');
        $val = DB::select('select * from v_coordinadores_resoluciones where idResolucion = '.$id[0].' and idCoordinador = '.$idCoordinador);
        if(count($val)==0){
            $coordinador->resoluciones()->attach($id);
            return redirect()->route('tecnico.coordinadores.edit',$coordinador)->with('info', 'La resolucion ha sido asignada, compruebe el campo resoluciones');
        }else{
            return redirect()->route('tecnico.coordinadores.edit',$coordinador)->with('info', 'Error: El coordinador ya ha sido asignada a la resolucion escogida');
        }
    }

    /**
     * Funcion que quita el coordinador de una resolucion
     */
    public function quitarCoordinador($idResolucion, $idCoordinador){
        $coordinador = Coordinador::find($idCoordinador);
        $coordinador->resoluciones()->detach($idResolucion);
        return redirect()->route('tecnico.coordinadores.edit',$coordinador)->with('info', 'Resolución quitada con éxito');
    }


}
