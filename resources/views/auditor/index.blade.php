@extends('layouts.convenios')
@section('workArea')
<section class="core">

    <div class="core__title">
        <span class="core__title--big">
            Convenios Interinstitucionales.
        </span>
        <span class="core__title--small">
            Tabla de Registros
        </span>
    </div> 
    <div class="core__content" style="height: 85%;">
        <!-- <div class="content__label">
            <span class="label__number">
                1
            </span>
            <span class="label__text">
                Convenios
            </span>
        </div> -->
        <div class="content__table" style="margin-top: 10px; height: 90%;">
            <table class="tabla display" id="Table__Convenios">
                <thead>
                    <tr class="col">
                        <th>#</th>
                        <th>Resolución</th>
                        <th>Convenio</th>
                        <th>Objeto del Convenio</th>
                        <th>Coordinador</th>
                        <th>Suscripción y Vigencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($convenios as $numero => $convenio)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td><b>{{$convenio->Resolucion}}</b></td>
                            <td>{{$convenio->texNombreConvenio}}
                            <td>{{$convenio->texObjetoConvenio}}</td>
                            <td>
                                @if(is_null($convenio->Coordinador)==false)
                                    {{$convenio->Coordinador->chaCargoCoordinador}}
                                    <br>
                                    {{$convenio->Coordinador->dependencia->vchNombreDependencia}}
                                    <br>
                                    Mediante 
                                    {{$convenio->Coordinador->pivot->chaNombreResolucion}}
                                    @if(is_null($convenio->Delegado)==false)
                                        <br>
                                        Delega a
                                        <br>
                                        {{$convenio->Delegado->chaCargoCoordinador}}
                                        <br>
                                        {{$convenio->Delegado->dependencia->vchNombreDependencia}}
                                        <br>
                                        Mediante 
                                        {{$convenio->Delegado->pivot->chaNombreResolucion}}
                                    @endif
                                @else
                                Sin Coordinador
                                @endif
                            </td>
                            @if(strcmp($convenio->texUrlConvenio,'Sin Link')!=0)
                                <a href="{{$convenio->texUrlConvenio}}" target="_blank"  class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-file" style="font-size: 18px;"></i>
                                    </span>
                                    <span class="button__table--spam">Ver Documento</span>
                                </a>                                 
                            @endif
                            </td>
                            <td>Suscrito
                                <br>
                                {{$convenio->datFechaInicioConvenio}}
                                <br>
                                <br>
                                Vigencia
                                <br>
                                {{$convenio->Vigencia}}
                            </td>
                            <td>
                                <a href="{{route('tecnico.convenios.show', $convenio)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection