@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <!-- Funcion que muestra una notificacion -->
    @if(session('info'))
    <div class="alert alert--info">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        {{session('info')}}
    </div>
    @endif
    <div class="core__title">
        <span class="core__title--big">
            Administración de Usuarios.
        </span>
        <span class="core__title--small">
            Tabla de Registros
        </span>
        
    </div>    
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <span class="label__text">
                Usuarios
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Usuarios">
                @can('admin.usuarios.create')
                <div class="button">
                    <a href="{{route('admin.usuarios.create')}}" class="nav__link nav__link--small">
                        <span class="link__icon--margin">
                            <i class="fa-solid fa-file"></i>
                        </span>
                        Nuevo
                    </a>
                </div>
                @endcan
                <thead>
                    <tr class="col">
                        <th>#</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $numero => $usuario)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>{{str_replace(array('"', '[', ']'),'',$usuario->getRoleNames())}}</td>
                            <td>
                                @can('admin.usuarios.show')
                                <!-- <a href="{{route('admin.usuarios.show', $usuario)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a> --> 
                                @endcan                               
                                <form action="{{route('admin.usuarios.destroy', $usuario->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('admin.usuarios.edit')
                                    <a href="{{url('/admin/usuarios/'.$usuario->id.'/edit')}}" class="button__table button__table--right">
                                        <span class="icon__button--update">
                                        <i class="fa-solid fa-pen"></i>
                                        </span>
                                        <span class="button__table--spam">Actualizar</span>
                                    </a>
                                    @endcan

                                    @can('admin.usuarios.destroy')
                                    <button type="submit" class="button__table button__table--right" onclick="return confirm('¿Seguro que deseas eliminar el registro?');">
                                        <span class="icon__button--delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </span>
                                        <span class="button__table--spam">Eliminar</span>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection