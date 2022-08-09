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
            Administración de Roles.
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
                Roles
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Roles">
                @can('admin.roles.create')
                <div class="button">
                    <a href="{{route('admin.roles.create')}}" class="nav__link nav__link--small">
                        <span class="link__icon--margin">
                            <i class="fa-solid fa-file"></i>
                        </span>
                        Nuevo
                    </a>
                </div>
                @endcan
                <thead>
                    <tr class="col">
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $rol)
                        <tr class="row">
                            <td>{{$rol->name}}</td>
                            <td>
                                @can('admin.roles.show')
                                <a href="{{route('admin.roles.show', $rol)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a> 
                                @endcan 
                                @can('admin.roles.edit')
                                <a href="{{url('/admin/roles/'.$rol->id.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a>
                                @endcan  
                                @can('admin.roles.destroy')
                                <button type="button" class="button__table button__table--right">
                                    <span class="icon__button--delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                    </span>
                                    <span class="button__table--spam">Eliminar</span>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</section>
@endsection