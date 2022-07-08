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
            Actualizar la Información del Coordinador
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
                                    <span class="label__text">Resoluciones</span>
                                </div>
                            </div>
                            <div class="content__form">
                                <!-- Formulario de laravel collective -->
                                {!! Form::model($coordinador, ['route' => ['tecnico.coordinadores.update', $coordinador], 'method'=>'put', 'class' => 'form']) !!}
                                    <p>
                                        {!! Form::label('Nombre', 'Nombre Completo') !!}
                                        {!! Form::text('Nombre', $coordinador->chaNombreCoordinador, ['class'=>'input form-control']) !!}
                                        @error('Nombre')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Cargo', 'Cargo del Coordinador') !!}
                                        {!! Form::text('Cargo', $coordinador->chaCargoCoordinador, ['class'=>'input form-control']) !!}
                                        @error('Cargo')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Titulo', 'Titulo del Coordinador') !!}
                                        {!! Form::text('Titulo', $coordinador->chaTituloCoordinador, ['class'=>'input form-control']) !!}
                                        @error('Titulo')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Celular', 'Celular del Coordinador') !!}
                                        {!! Form::text('Celular', $coordinador->chaCelularCoordinador, ['class'=>'input form-control']) !!}
                                        @error('Celular')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Dependencia', 'Dependencia') !!}
                                        <select name="Dependencia" id="Dependencia" class="form-select">
                                            @foreach($dependencias as $dependencia)
                                                @if($dependencia->idDependencia == $coordinador->idDependencia)
                                                <option selected value="{{$dependencia->idDependencia}}">{{$dependencia->vchNombreDependencia}}</option>
                                                @else
                                                <option value="{{$dependencia->idDependencia}}">{{$dependencia->vchNombreDependencia}}</option>
                                                @endif
                                                
                                            @endforeach
                                        </select>
                                    </p>

                                    <p class="block">
                                        <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>    Registrar</span>
                                        </button>
                                    </p>
                                {!! Form::close() !!}
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
                                    <span class="label__text">Resoluciones</span>
                                </div>
                            </div>
                            <div class="content_convenio">
                                <div class="wrapper__row-1">
                                    <div class="fila">
                                        <span class="fila__label">Asigne una nueva resolución</span>
                                        {!! Form::model($coordinador, ['route' => ['tecnico.resoluciones.asignarCoordinador', $coordinador], 'method'=>'put', 'class' => 'form']) !!}
                                            <p>
                                                {!! Form::text('Resolucion', null, ['class'=>'input form-control', 'id' => 'Resolucion', 'placeholder'=>'Busque una resolución']) !!}
                                                @error('Resolucion')
                                                <span class="text--danger">{{$message}}</span>
                                                @enderror
                                            </p>
                                            <button type="submit" class="button--plus" style="padding:5px;width:fit-content; height: fit-content;"><span>  <i class="fa-solid fa-plus"></i> <span> </span>    Asignar</span>
                                            </button>
                                        {!! Form::close() !!}
                                            
                                        @if(count($resoluciones)==0)
                                            <p class="fila__text">No posee Resoluciones</p>
                                        @else
                                        <table class="tabla display" id="Table__Resoluciones">
                                            <div class="button">
                                                <a href="{{route('tecnico.resoluciones.create')}}" class="nav__link nav__link--small">
                                                    <span class="link__icon--margin">
                                                        <i class="fa-solid fa-file"></i>
                                                    </span>
                                                    Nuevo
                                                </a>
                                            </div>
                                            <thead>
                                                <tr class="col">
                                                    <th>ID</th>
                                                    <th>Resolucion</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($resoluciones as $resolucion)
                                                    <tr class="row">
                                                        <td>{{$resolucion->idResolucion}}</td>
                                                        <td>{{$resolucion->chaNombreResolucion}}</td>
                                                        <td>{{$resolucion->datFechaResolucion}}</td>
                                                        @if($resolucion->sinTipoResolucion == 1)
                                                        <td>Resolución</td>
                                                        @else
                                                        <td>Oficio</td>
                                                        @endif
                                                        <td>
                                                        {!! Form::model($resolucion, ['route' => ['tecnico.resoluciones.quitarCoordinador', $resolucion, $coordinador], 'method'=>'put']) !!}
                                                            
                                                            <a href="{{route('tecnico.resoluciones.show', $resolucion)}}" class="button__table">
                                                                <span class="icon__button--view">
                                                                <i class="fa-solid fa-eye"></i>
                                                                </span>
                                                                <span class="button__table--spam">Ver</span>
                                                            </a>
                                                            <button type="submit" class="button__table  button__table button__table--right">
                                                                <span class="icon__button--delete">
                                                                <i class="fa-solid fa-minus" style="font-size: 15px;"></i>
                                                                </span>
                                                                <span class="button__table--spam">Quitar</span>
                                                            </button>
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
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
    </div>
</section>
@endsection
@section('js')
<script>
    $( function() {
        var resoluciones =  <?php echo json_encode($resoluciones2); ?>;
        $( "#Resolucion" ).autocomplete({
        source: resoluciones
        });
    } );
  </script>
@endsection