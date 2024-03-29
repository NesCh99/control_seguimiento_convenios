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
            Administración de Resoluciones.
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
                Resoluciones
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Resoluciones">
                @can('tecnico.resoluciones.create')
                <div class="button">
                    <a href="{{route('tecnico.resoluciones.create')}}" class="nav__link nav__link--small">
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
                        <th>Resolucion</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resoluciones as $numero => $resolucion)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td>{{$resolucion->chaNombreResolucion}}</td>
                            @if($resolucion->sinTipoResolucion == 1)
                            <td>Resolución</td>
                            @else
                            <td>Oficio</td>
                            @endif
                            <td>
                                @can('tecnico.resoluciones.show')
                                <a href="{{route('tecnico.resoluciones.show', $resolucion)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver Convenios</span>
                                </a>
                                @endcan 
                                @can('tecnico.resoluciones.edit')
                                <a href="{{url('/tecnico/resoluciones/'.$resolucion->idResolucion.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a> 
                                @endcan  
                                @can('tecnico.resoluciones.destroy')
                                <button type="submit" class="button__table  button__table button__table--right" onclick="return confirm('¿Seguro que deseas eliminar el registro?');">
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

                