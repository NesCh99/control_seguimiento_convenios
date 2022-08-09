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
            Administración de Eje.
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
                Ejes
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Ejes">
                @can('admin.ejes.create')
                <div class="button">
                    <a href="{{route('admin.ejes.create')}}" class="nav__link nav__link--small">
                        <span class="link__icon--margin">
                            <i class="fa-solid fa-file"></i>
                        </span>
                        Nuevo
                    </a>
                </div>
                @endcan
                <thead>
                    <tr class="col">
                        <th>ID</th>
                        <th>Dependencia</th>
                        <th>Fecha de Creación</th>
                        <th>Fecha de Modificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ejes as $eje)
                        <tr class="row">
                            <td>{{$eje->idEje}}</td>
                            <td>{{$eje->chaNombreEje}}</td>
                            <td>{{$eje->tstCreacionEje}}</td>
                            <td>{{$eje->tstModificacionEje}}</td>
                            <td>
                                @can('admin.ejes.show')
                                <a href="{{route('admin.ejes.show', $eje)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a> 
                                @endcan      
                                @can('admin.ejes.edit')
                                <a href="{{url('/admin/ejes/'.$eje->idEje.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a>
                                @endcan 
                                @can('admin.ejes.destroy')
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