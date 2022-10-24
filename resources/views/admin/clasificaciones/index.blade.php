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
            Administración de Clasificaciones.
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
                Clasificaciones
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Clasificaciones">
                @can('admin.clasificaciones.create')
                <div class="button">
                    <a href="{{route('admin.clasificaciones.create')}}" class="nav__link nav__link--small">
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
                        <th>Clasificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clasificaciones as $numero => $clasificacion)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td>{{$clasificacion->chaNombreClasificacion}}</td>
                            <td>
                            <form action="{{route('admin.clasificaciones.destroy', $clasificacion->idClasificacion)}}" method="POST">
                            @csrf
                            @method('DELETE')                               
                                @can('admin.clasificaciones.show')
                                <a href="{{route('admin.clasificaciones.show', $clasificacion)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver Convenios</span>
                                </a> 
                                @endcan      
                                @can('admin.clasificaciones.edit')
                                <a href="{{url('/admin/clasificaciones/'.$clasificacion->idClasificacion.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a>
                                @endcan
                                @can('admin.clasificaciones.destroy')
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


