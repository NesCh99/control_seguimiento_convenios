
@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
               Dependencias de la ESPOCH
        </span>
        <span class="core__title--small">
            Información General de la Dependencia
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
                        </div>
         <!--Información General -->
                        <div class="content_convenio">
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">ID de la Dependencia</span>
                                    <p class="fila__text"><b>{{$dependencia->idDependencia}}</b></p>
                                </div>

                                <div class="fila">
                                    <span class="fila__label">Nombre de la Dependencia</span>
                                    <p class="fila__text">{{$dependencia->vchNombreDependencia}}</p>
                                </div>
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">Fecha de Registro</span>
                                    <p class="fila__text"><b>{{$dependencia->tstCreacionDependencia}}</b></p>
                                </div>

                                <div class="fila">
                                    <span class="fila__label">Fecha de ultima Modificación</span>
                                    <p class="fila__text">{{$dependencia->tstModificacionDependencia}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>

                            <div class="label label--next">
                                <span class="label__number">2</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                        </div>
                        <!--Información relacionada de Coordinadores -->
                        <div class="core__content">
                            <div class="content_convenio">
                                <div class="content__table">
                                    <table class="tabla display" id="Table__Coordinadores">
                                        <thead>
                                            <tr class="col">
                                                <th>ID</th>
                                                <th>Coordinador</th>
                                                <th>Contacto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dependencia->coordinadores as $coordinador)
                                                <tr class="row">
                                                    <td><b>{{$coordinador->idCoordinador}}</b></td>
                                                    <td>{{$coordinador->chaNombreCoordinador}}</td>
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
                                                        <button type="button" class="button__table button__table--right">
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