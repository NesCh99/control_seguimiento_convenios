
@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
               Convenios
        </span>
        <span class="core__title--small">
            Información General del Convenio
        </span>

    </div>
    <div class="core__content">
        <div class="container__swiper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label">
                                <span class="label__number">1</span>
                                <span class="label__text">Información General</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">2</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
                                <span class="label__text">Informes</span>
                            </div>
                        </div>
                    <!--Información General -->
                        <div class="content_convenio">
                            <div class="fila">
                                <span class="fila__label">Nombre del Convenio
                                @if(strcmp($convenio->texUrlConvenio,'Sin Link')!=0)
                                    <a href="{{$convenio->texUrlConvenio}}" target="_blank"  class="button__table button__table--right">
                                        <span class="icon__button--update">
                                        <i class="fa-solid fa-file" style="font-size: 18px;"></i>
                                        </span>
                                        <span class="button__table--spam">Ver Documento</span>
                                    </a>                                 
                                @endif
                                </span>
                                <p class="fila__text">{{$convenio->texNombreConvenio}}</p>
                            </div>
                            <span style="padding: 5px;" class="fila__label">Resoluciones del Convenio</span>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Nombre de la Resolución</span>                                    
                                </div>

                                <div class="fila">
                                    <span class="fila__label">Objeto de la Resolución</span>
                                </div>
                            </div>
                            @if(count($convenio->resoluciones)==0)
                            <div class="fila">
                                <p class="fila__text">No posee Resoluciones</p>
                            </div>
                            @else
                            @foreach($convenio->resoluciones as $resolucion)
                                <div class="wrapper">
                                    <div class="fila">
                                        <p class="fila__text">{{$resolucion->chaNombreResolucion}}</p>
                                    </div>

                                    <div class="fila">
                                        <p class="fila__text">{{$resolucion->texObjetoResolucion}}</p>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            <div class="wrapper wrapper__row-3">
                                <div class="fila">
                                    <span class="fila__label">Fecha de Inicio del Convenio</span>
                                    <p class="fila__text">{{$convenio->datFechaInicioConvenio}}</p>
                                </div>
                                <div class="fila">
                                    <span class="fila__label">Fecha de Fin del Convenio</span>
                                    <p class="fila__text">{{$convenio->datFechaFinConvenio}}</p>
                                </div>
                                <div class="fila">
                                    <span class="fila__label">Estado del Convenio</span>
                                    <p class="fila__text">{{$estado}}</p>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Clasificacion del Convenio</span>
                                    <p class="fila__text">{{$convenio->clasificacion->chaNombreClasificacion}}</p>
                                </div>
                                <div class="fila">                              
                                    <span class="fila__label">Ejes de Acción</span>
                                    @if(count($convenio->ejes)==0)
                                        <p class="fila__text">Sin Ejes</p>
                                    @else
                                        @foreach($convenio->ejes as $eje)
                                            <p class="fila__text">{{$eje->chaNombreEje}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Criterio Parcial</span>
                                    <p class="fila__text">{{$criterioParcial}}</p>
                                </div>
                                <div class="fila">
                                    <span class="fila__label">Cumplimiento Parcial</span>
                                    <p class="fila__text">{{$cumplimientoParcial}}%</p>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Criterio Total</span>
                                    <p class="fila__text">{{$criterioTotal}}</p>
                                </div>
                                <div class="fila">
                                    <span class="fila__label">Cumplimiento Total</span>
                                    <p class="fila__text">{{$cumplimientoTotal}}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--Información relacionada de Coordinadores del Convenio-->
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number  label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>
                            <div class="label label--next">
                                <span class="label__number">2</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
                                <span class="label__text">Informes</span>
                            </div>
                        </div>
                        <div class="content_convenio">
                            <div class="fila">
                                <span class="fila__label">Coordinadores</span>
                                @if(count($convenio->coordinadores) == 0)
                                    <p class="fila__text">
                                        No Posee Coordinadores
                                    </p>
                                @else
                                <div class="content__table">
                                    <table class="tabla display" id="Table__Coordinadores">
                                        <thead>
                                            <tr class="col">
                                                <th>ID</th>
                                                <th>Coordinador</th>
                                                <th>Cargo</th>
                                                <th>Dependencia</th>
                                                <th>Celular</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($convenio->coordinadores as $coordinador)
                                                <tr class="row">
                                                    <td>{{$coordinador->idCoordinador}}</td>
                                                    <td>{{$coordinador->chaTituloCoordinador.' '.$coordinador->chaNombreCoordinador}}</td>
                                                    <td>{{$coordinador->chaCargoCoordinador}}</td>
                                                    <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                    <td>{{$coordinador->chaCelularCoordinador}}</td>
                                                    <td>
                                                        <a href="{{route('tecnico.coordinadores.show', $coordinador)}}" class="button__table">
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
                                @endif
                            </div>
                        </div>
                    </div>
                <!-- Informes del Convenio -->
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number  label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">2</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                            <div class="label label--next">
                                <span class="label__number">3</span>
                                <span class="label__text">Informes</span>
                            </div>                               
                        </div>
                        <div class="content_convenio">
                            <div class="fila">
                                <span class="fila__label">Informes Presentados</span>
                                @if(count($informesPresentados) == 0)
                                    <p class="fila__text">
                                        No Posee Informes Presentados
                                    </p>
                                @else
                                <div class="content__table">
                                    <table class="tabla display" id="Table__InformesPresentados">
                                        <thead>
                                            <tr class="col">
                                                <th>Descripcion</th>
                                                <th>Fecha de Ingreso del Informe</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($informesPresentados as $informe)
                                                <tr class="row">
                                                    <td>{{$informe->texDescripcionInforme}}</td>
                                                    <td>{{$informe->tstCreacionInforme}}</td>
                                                    <td>
                                                        <a href="" class="button__table">
                                                            <span class="icon__button--view">
                                                            <i class="fa-solid fa-minus"></i>
                                                            </span>
                                                            <span class="button__table--spam">Quitar</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                            <div class="fila">
                                <span class="fila__label">Informes Pendientes</span>
                                @if(count($informes) == 0)
                                    <p class="fila__text">
                                        No Posee Informes Pendientes
                                    </p>
                                @else
                                <div class="content__table">
                                    <table class="tabla display" id="Table__InformesPresentados">
                                        <thead>
                                            <tr class="col">
                                                <th>Descripcion</th>
                                                <th>Fecha de Ingreso del Informe</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($informes as $informe)
                                                <tr class="row">
                                                    <td>{{$informe->texDescripcionInforme}}</td>
                                                    <td>{{$informe->tstCreacionInforme}}</td>
                                                    <td>
                                                        <a href="" class="button__table">
                                                            <span class="icon__button--view">
                                                            <i class="fa-solid fa-plus"></i>
                                                            </span>
                                                            <span class="button__table--spam">Presentar</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div> 
    </div>
    <!-- Botones que cambian de pantalla -->
    <div class="swiper__buttons">
        <div class="swiper-button-next ">
            <span class=" slider__btn slider__btn--left">
            <span>Siguiente</span>  <i class="fa-solid fa-arrow-right"></i></span>
        </div>
        <div class="swiper-button-prev">
            <span class=" slider__btn slider__btn--right">
            <i class="fa-solid fa-arrow-left"></i> <span>Anterior</span>
            </span>
        </div>
    </div>
</section>

@endsection