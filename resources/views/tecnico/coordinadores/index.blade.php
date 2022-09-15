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
            Administración de Coordinadores.
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
                Coordinadores
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Coordinadores">
                @can('tecnico.coordinadores.create')
                <div class="button">
                    <a href="{{route('tecnico.coordinadores.create')}}" class="nav__link nav__link--small">
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
                        <th>Dependencia</th>
                        <th>Cargo</th>
                        <th>Coordinador</th>
                        <th>Resoluciones</th>
                        <th>Celular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coordinadores as $numero => $coordinador)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                            <td>{{$coordinador->chaCargoCoordinador}}</td>
                            <td>{{$coordinador->chaTituloCoordinador.' '.$coordinador->chaNombreCoordinador}}</td>
                            <td>
                                @if(count($coordinador->resoluciones)!=0)
                                    @foreach($coordinador->resoluciones as $resolucion)
                                        {{$resolucion->chaNombreResolucion}}
                                        <br>
                                    @endforeach
                                @else
                                Aún no se asignan resoluciones
                                @endif
                            </td>
                            <td>{{$coordinador->chaCelularCoordinador}}</td>
                            <td>
                                @can('tecnico.coordinadores.show')
                                <a href="{{route('tecnico.coordinadores.show', $coordinador)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a>
                                @endcan 
                                @can('tecnico.coordinadores.edit')
                                <a href="{{url('/tecnico/coordinadores/'.$coordinador->idCoordinador.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a>  
                                @endcan 
                                @can('tecnico.convenios.destroy')
                                <button type="button" class="button__table  button__table button__table--right">
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

                