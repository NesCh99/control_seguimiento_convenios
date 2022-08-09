<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.usuarios.index')->only('index');
        $this->middleware('can:admin.usuarios.create')->only('create');
        $this->middleware('can:admin.usuarios.edit')->only('edit');
        $this->middleware('can:admin.usuarios.show')->only('show');
        $this->middleware('can:admin.usuarios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $n = 1;
        foreach($usuarios as $usuario){
            $usuario['cantidad'] = $n;
        }
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->toArray(); //envia el array de todos los roles, sirve para el select
        return view('admin.usuarios.create', compact('roles'));
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
            'Email' => 'required|email|unique:users,email',
            'Rol' => 'required'
        ]);

        $usuario = User::create([
            'email' => $request->input('Email'),
        ])->assignRole($request->input('Rol'));

        return redirect()->route('admin.usuarios.index')->with('info', $usuario->email . ' ha sido registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idUsuario)
    {
        $usuario = User::findOrFail($idUsuario);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idUsuario)
    {
        $usuario = User::findOrFail($idUsuario);
        $roles = Role::pluck('name','id')->toArray(); //envia el array de todos los roles, sirve para el select
        return view('admin.usuarios.edit', compact(['usuario', 'roles']));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUsuario)
    {
        $usuario = User::findOrFail($idUsuario);
        $request->validate([
            'Email' => "required|email|unique:users,email,$usuario->id,id",
            'roles' => 'required'
        ]);
        $usuario->update([
            'email' => $request->input('Email')
        ]);
        $usuario->roles()->sync($request->roles);
        return redirect()->route('admin.usuarios.index')->with('info',$usuario->email.' ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUsuario)
    {
        $usuario = User::findOrFail($idUsuario);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('info', $usuario->email.' ha sido eliminado con éxito');
    }
}
