<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clasificacion;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.clasificaciones.index')->only('index');
        $this->middleware('can:admin.clasificaciones.create')->only('create');
        $this->middleware('can:admin.clasificaciones.edit')->only('edit');
        $this->middleware('can:admin.clasificaciones.show')->only('show');
        $this->middleware('can:admin.clasificaciones.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $clasificaciones = Clasificacion::all();
        
        return view('admin.clasificaciones.index', compact('clasificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clasificaciones.create');
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
            'Nombre'=>'required|unique:v_clasificaciones,chaNombreClasificacion'
        ]);
        $clasificacion = Clasificacion::create([
            'chaNombreClasificacion'  => $request->input('Nombre')
        ]);
        return redirect()->route('admin.clasificaciones.index', $clasificacion)->with('info', $clasificacion->chaNombreClasificacion.' ha sido registrado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idClasificacion)
    {
        $clasificacion = Clasificacion::find($idClasificacion);
        return view('admin.clasificaciones.show', compact('clasificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idClasificacion)
    {
        $clasificacion = Clasificacion::find($idClasificacion);
        return view('admin.clasificaciones.edit', compact('clasificacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idClasificacion)
    {
        $clasificacion = Clasificacion::find($idClasificacion);
        $request->validate([
            'Nombre'=>"required|unique:v_clasificaciones,chaNombreClasificacion,$clasificacion->idClasificacion,idClasificacion",
        ]);
        
        $clasificacion->update([
            'chaNombreClasificacion' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.clasificaciones.index', $clasificacion)->with('info', $clasificacion->chaNombreClasificacion.' ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idClasificacion)
    {
        $clasificacion = Clasificacion::find($idClasificacion);
    }
}

