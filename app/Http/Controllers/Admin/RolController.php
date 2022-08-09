<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create');
        $this->middleware('can:admin.roles.edit')->only('edit');
        $this->middleware('can:admin.roles.show')->only('show');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create', compact('permisos'));
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
            'Nombre' => 'required|unique:roles,name'
        ]);

        $role = Role::create([ //Se crea un nuevo rol
            'name' => $request->input('Nombre')
        ]);

        $role->permissions()->sync($request->permisos); //asignamos los permisos al rol

        return redirect()->route('admin.roles.index')->with('info', $role->name.' se creó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Role::find($id);
        $permisos = $rol->permissions;
        return view('admin.roles.show', compact('rol', 'permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idRol)
    {
        $permisos = Permission::all();
        $rol = Role::find($idRol);
        return view('admin.roles.edit', compact('rol', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idRol)
    {
        $rol = Role::find($idRol);
        $request->validate([
            'Nombre' => "required|unique:roles,name,$rol->id,id",
            'permissions' => 'required'
        ]);
        $rol->permissions()->sync($request->permissions);
        $rol->update([
            'name' => $request->input('Nombre')
        ]);
        return redirect()->route('admin.roles.show', $rol)->with('info', $rol->name.' se ha actualizado con éxito');
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
