
@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Convenios Institucionales
        </span>

        <span class="core__title--small">
            Registrar Nuevo Convenio
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
                        </div>
                        <!-- Formulario de laravel collective -->
                        {!! Form::open(['route'=>'tecnico.convenios.store', 'class' => 'form-control']) !!}
                        <!--Content -->
                        <div class="content_convenio">
                            <div class="fila">
                                <span class="fila__label">
                                    Nombre del Convenio
                                </span>
                                {!! Form::textarea('Nombre', null, ['class'=>'input form-control', 'style' => 'height:40px;']) !!}
                                @error('Nombre')
                                <span class="text--danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="fila">
                                <span class="fila__label">
                                    Link del Documento del Convenio
                                </span>
                                {!! Form::text('Link', null, ['class'=>'input form-control']) !!}
                                @error('Link')
                                <span class="text--danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="wrapper wrapper__row-4">
                                <div class="fila">
                                    <span class="fila__label">
                                        Clasificación
                                    </span>
                                    <select class="input form-control" name="Clasificacion" id="Clasificacion">
                                        @foreach($clasificaciones as $clasificacion)
                                            <option value="{{$clasificacion->idClasificacion}}">{{$clasificacion->chaNombreClasificacion}}</option>
                                        @endforeach
                                    </select>                                    
                                </div>   
                                <div class="fila">
                                    <span class="fila__label">
                                        Fecha de Inicio del Convenio
                                    </span>
                                    {{ Form::date('Fecha', null, ['class' => 'input form-control']) }}
                                    @error('Fecha')
                                        <span class="text--danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fila">
                                    <span class="fila__label">
                                        Vigencia: Años
                                    </span>
                                    {{ Form::selectRange('Años', 0, 12, null, ['class' => 'input form-control'])}}
                                    @error('Años')
                                        <span class="text--danger">{{$message}}</span>
                                    @enderror
                                    
                                </div>
                                <div class="fila">
                                <span class="fila__label">
                                        Vigencia: Meses
                                    </span>
                                    {{ Form::selectRange('Meses', 0, 11, null, ['class' => 'input form-control'])}}
                                    @error('Meses')
                                        <span class="text--danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="wrapper wrapper__row-1 campoEjes">
                                <div class="fila">
                                    <span class="fila__label">
                                            Ejes de Acción
                                        </span>
                                    <div class="wrapper wrapper__row-4">
                                        @foreach($ejes as $eje)
                                            <div>
                                                <label>
                                                    {!! Form::checkbox('ejes[]', $eje->idEje, null, ['class'=>'form-control']) !!}
                                                    {{$eje->chaNombreEje}}
                                                </label>
                                            </div>
                                        @endforeach                                        
                                    </div>
                                    @error('ejes')
                                            <span class="text--danger">{{$message}}</span>
                                        @enderror
                                </div>
                            </div>                            
                        </div>
                        <p class="block">
                                <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>    Registrar</span>
                                </button>
                            </p>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('overlay')
<script src="/js/overlay.js"></script> 
<script>    
    /* Funcion que esconde los ejes cuando se escoge la clasificación internacional en el select */
    $('#Clasificacion').on('change', function(){
        var seleccionado = $("#Clasificacion option:selected" ).text();
        
        if(seleccionado == 'Internacional'){
            $('.campoEjes').hide();
        }else{
            $('.campoEjes').show();
        }
    });
    /* Funcion que esconde los ejes en caso de ser internacional cuando se carga la página*/
    function esconder(){
        var seleccionado = $("#Clasificacion option:selected" ).text();
        
        if(seleccionado == 'Internacional'){
            $('.campoEjes').hide();
        }else{
            $('.campoEjes').show();
        }
    };
    window.onload = esconder;
</script>
@endsection