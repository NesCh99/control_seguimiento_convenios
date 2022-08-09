<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.dependencias.index')->only('index');
        $this->middleware('can:admin.dependencias.create')->only('create');
        $this->middleware('can:admin.dependencias.edit')->only('edit');
        $this->middleware('can:admin.dependencias.show')->only('show');
        $this->middleware('can:admin.dependencias.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencias = Dependencia::all();
        return view('admin.dependencias.index', compact('dependencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dependencias.create');
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
            'Nombre'=>'required|unique:v_dependencias,vchNombreDependencia'
        ]);
        
        $dependencia = Dependencia::create([
            'vchNombreDependencia' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.dependencias.index', $dependencia)->with('info', $dependencia->vchNombreDependencia.' ha sido registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idDependencia)
    {
        $dependencia =  Dependencia::find($idDependencia);
        return view('admin.dependencias.show', compact('dependencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idDependencia)
    {
        $dependencia = Dependencia::find($idDependencia);
        return view('admin.dependencias.edit', compact('dependencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idDependencia)
    {
        $dependencia = Dependencia::find($idDependencia);
        $request->validate([
            'Nombre'=>"required|unique:v_dependencias,vchNombreDependencia,$dependencia->idDependencia,idDependencia",
        ]);
        
        $dependencia->update([
            'vchNombreDependencia' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.dependencias.index', $dependencia)->with('info', $dependencia->vchNombreDependencia.' ha sido actualizado con éxito');
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
