<?php

namespace App\Http\Controllers\Tecnico;

use App\Http\Controllers\Controller;
use App\Models\Coordinador;
use App\Models\Dependencia;
use App\Models\Resolucion;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CoordinadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tecnico.coordinadores.index')->only('index');
        $this->middleware('can:tecnico.coordinadores.create')->only('create');
        $this->middleware('can:tecnico.coordinadores.edit')->only('edit');
        $this->middleware('can:tecnico.coordinadores.show')->only('show');
        $this->middleware('can:tecnico.coordinadores.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coordinadores = Coordinador::all();
        return view('tecnico.coordinadores.index', compact('coordinadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependencias = Dependencia::all();
        return view('tecnico.coordinadores.create', compact(['dependencias']));
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
            'Cargo'=> 'required',
            'Dependencia' => 'required'
        ]);

        $nombre = $request->input('Nombre');
        $contacto = $request->input('Celular');
        $titulo = $request->input('Titulo');

        if(strlen($nombre)==0){
            $nombre = 'Sin Nombre';
        }
        if(strlen($titulo)==0){
            $titulo = 'Sin Titulo';
        }
        if(strlen($contacto)==0){
            $contacto = '0000000000';
        }
        $coordinador = Coordinador::create([
            'idDependencia' => $request->input('Dependencia'),
            'chaNombreCoordinador' => $nombre,
            'chaTituloCoordinador' => $titulo,
            'chaCargoCoordinador' => $request->input('Cargo'),
            'chaCelularCoordinador' => $contacto,
        ]);
        return redirect()->route('tecnico.coordinadores.edit', $coordinador)->with('info', $coordinador->chaNombreCoordinador.' ha sido registrado con éxito, por favor asigne resoluciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idCoordinador)
    {
        $coordinador = Coordinador::find($idCoordinador);
        return view('tecnico.coordinadores.show', compact('coordinador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idCoordinador)
    {
        $coordinador = Coordinador::find($idCoordinador);
        $dependencias = Dependencia::all();
        $resoluciones = $coordinador->resoluciones;
        $resoluciones2 = Resolucion::pluck('chaNombreResolucion')->toArray(); //Envia las resoluciones para el autocompletar
        return view('tecnico.coordinadores.edit', compact('coordinador', 'dependencias', 'resoluciones', 'resoluciones2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCoordinador)
    {
        $coordinador = Coordinador::find($idCoordinador);
        $request->validate([
            'Cargo'=> 'required',
            'Titulo'=>'required',
        ]);

        $nombre = $request->input('Nombre');
        $contacto = $request->input('Celular');
        $titulo = $request->input('Titulo');

        if(strlen($nombre)==0){
            $nombre = 'Sin Nombre';
        }
        if(strlen($titulo)==0){
            $titulo = 'Sin Titulo';
        }
        if(strlen($contacto)==0){
            $contacto = '0000000000';
        }

        $coordinador->update([
            'idDependencia' => $request->input('Dependencia'),
            'chaNombreCoordinador' => $nombre,
            'chaTituloCoordinador' => $titulo,
            'chaCargoCoordinador' => $request->input('Cargo'),
            'chaCelularCoordinador' => $contacto,
        ]);

        return redirect()->route('tecnico.coordinadores.index', $coordinador)->with('info', $coordinador->chaNombreCoordinador.' ha sido actualizado con éxito');
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
