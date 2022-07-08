
@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
               Resoluciones
        </span>
        <span class="core__title--small">
            Información General de la Resolución
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
                                <span class="label__text">Convenios</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                        </div>
                        <div class="content_convenio">
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">ID de la Resolución</span>
                                    <p class="fila__text"><b>{{$resolucion->idResolucion}}</b></p>
                                </div>

                                <div class="fila">
                                    <span class="fila__label">Nombre de la Resolucion
                                    @if(strcmp($resolucion->texUrlResolucion,'Sin Link')!=0)
                                        <a href="{{$resolucion->texUrlResolucion}}" target="_blank"  class="button__table button__table--right">
                                            <span class="icon__button--update">
                                            <i class="fa-solid fa-file" style="font-size: 18px;"></i>
                                            </span>
                                            <span class="button__table--spam">Ver Documento</span>
                                        </a>                                 
                                    @endif
                                    </span>
                                    <p class="fila__text">{{$resolucion->chaNombreResolucion}}</p>
                                </div>
                            </div>
                            <div class="wrapper__row-1 ">
                                <div class="fila">
                                    <span class="fila__label">Objeto de la Resolución</span>
                                    <p class="fila__text"><b>{{$resolucion->texObjetoResolucion}}</b></p>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Fecha de Registro</span>
                                    <p class="fila__text"><b>{{$resolucion->tstCreacionResolucion}}</b></p>
                                </div>

                                <div class="fila">
                                    <span class="fila__label">Fecha de ultima Modificación</span>
                                    <p class="fila__text">{{$resolucion->tstModificacionResolucion}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number  label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>

                            <div class="label label--next">
                                <span class="label__number">2</span>
                                <span class="label__text">Convenios</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                        </div>
                        <!--Información relacionada de Convenios -->
                        <div class="core__content">
                            <div class="content_convenio">
                                <div class="content__table">
                                    <table class="tabla display" id="Table__Convenios">
                                        <thead>
                                            <tr class="col">
                                                <th>ID</th>
                                                <th>Convenio</th>
                                                <th>Fecha de Inicio</th>
                                                <th>Fecha de Fin</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($resolucion->convenios as $convenio)
                                                <tr class="row">
                                                    <td><b>{{$convenio->idConvenio}}</b></td>
                                                    <td>{{$convenio->texNombreConvenio}}</td>
                                                    <td>{{$convenio->datFechaInicioConvenio}}</td>
                                                    <td>{{$convenio->datFechaFinConvenio}}</td>
                                                    <td>
                                                        <a href="{{route('tecnico.convenios.show', $convenio)}}" class="button__table button__table--right">
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
                        </div> 
                    </div>
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number  label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>

                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">2</span>
                                <span class="label__text">Convenios</span>
                            </div>
                            <div class="label label--next">
                                <span class="label__number">3</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                        </div>
                        <div class="core__content">
                            <div class="content_convenio">
                                <div class="content__table">
                                    <table class="tabla display" id="Table__Coordinadores">
                                        <thead>
                                            <tr class="col">
                                                <th>ID</th>
                                                <th>Coordinador</th>
                                                <th>Dependencia</th>
                                                <th>Celular</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($resolucion->coordinadores as $coordinador)
                                                <tr class="row">
                                                    <td>{{$coordinador->idCoordinador}}</td>
                                                    <td>{{$coordinador->chaNombreCoordinador}}</td>
                                                    <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                    @if(is_null($coordinador->chaCelularCoordinador))
                                                    <td>Sin contacto</td>
                                                    @else
                                                    <td>{{$coordinador->chaCelularCoordinador}}</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{route('tecnico.coordinadores.show', $coordinador)}}" class="button__table">
                                                            <span class="icon__button--view">
                                                            <i class="fa-solid fa-eye"></i>
                                                            </span>
                                                            <span class="button__table--spam">Ver</span>
                                                        </a>
                                                        <a href="{{url('/tecnico/coordinadores/'.$coordinador->idCoordinador.'/edit')}}" class="button__table button__table--right">
                                                            <span class="icon__button--update">
                                                            <i class="fa-solid fa-pen"></i>
                                                            </span>
                                                            <span class="button__table--spam">Actualizar</span>
                                                        </a>   
                                                        <button type="button" class="button__table  button__table button__table--right">
                                                            <span class="icon__button--delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                            </span>
                                                            <span class="button__table--spam">Eliminar</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    </div>
</section>

@endsection