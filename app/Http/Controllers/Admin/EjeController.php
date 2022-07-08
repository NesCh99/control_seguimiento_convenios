<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eje;
use Illuminate\Http\Request;

class EjeController extends Controller
{
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
        return view('admin.ejes.show', compact('eje'));
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
    public function destroy($id)
    {
        //
    }
}
