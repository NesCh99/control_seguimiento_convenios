<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechaAhora = date_create(date('Y-m-d'));
        $convenios = Convenio::where('datFechaFinConvenio','>=',$fechaAhora)->get();
        $conveniosPorCaducar = null;
        /**
         * Guarda los convenios por Caducar en $convenios Por Caducar
         */
        foreach($convenios as $convenio){
            $fechaFin = date_create($convenio->datFechaFinConvenio);
            $intervalo = round((date_diff($fechaFin,$fechaAhora)->days)/30);
            if($intervalo <= 6){
                $conveniosPorCaducar[] = $convenio;
            }
        }
        return view('index', compact('conveniosPorCaducar'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
