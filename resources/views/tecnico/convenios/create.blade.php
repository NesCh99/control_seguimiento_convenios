
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
                                    Objeto del Convenio
                                </span>
                                {!! Form::textarea('Objeto', null, ['class'=>'input form-control', 'style' => 'height:40px;']) !!}
                                @error('Objeto')
                                <span class="text--danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="wrapper">
                                <div class="fila">
                                    <span class="fila__label">
                                        Resolución de Aprobación del Convenio
                                    </span>
                                    {!! Form::text('Resolucion', null, ['class'=>'input form-control', 'id' => 'Resolucion', 'placeholder'=>'Busque una resolución existente']) !!}
                                    @error('Resolucion')
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
                            </div>
                            
                            <div class="wrapper wrapper__row-4">
                                <div class="fila">
                                    <span class="fila__label">
                                        Clasificación
                                    </span>
                                    {!! Form::select('Clasificacion', $clasificaciones, null, ['class'=>'input form-control', 'id'=>'Clasificacion', 'onchange'=>'esconderClasificacion()']) !!}                             
                                    @error('Clasificacion')
                                        <span class="text--danger">{{$message}}</span>
                                    @enderror
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
                                    {{ Form::selectRange('Años', 0, 20, null, ['class' => 'input form-control'])}}
                                    @error('Años')
                                        <span class="text--danger">{{$message}}</span>
                                    @enderror   
                                    <div class="form-control">
                                        <span class="fila__label">
                                            Indeterminado
                                        </span>
                                        
                                        {!! Form::checkbox('indeterminado','true', null, ['class'=>'form-control','id'=>'indeterminado', 'onchange' => 'deshabilitarVigencia()']) !!}
                                    </div>                                 
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
                                                    {!! Form::checkbox('ejes[]', $eje->idEje, null, ['class'=>'form-control', 'id' => 'check']) !!}
                                                    {!! Form::radio('ejes[]', $eje->idEje, null, ['class'=>'form-control', 'id' => 'radio']) !!}
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
    /* Funcion que esconde los ejes en caso de ser internacional*/
    function esconderClasificacion(){
        var seleccionado = $("#Clasificacion option:selected" ).val();
        
        if(seleccionado == '3'){
            $('.campoEjes').hide();
        }else{
            $('.campoEjes').show();
        }

        if(seleccionado == '2'){
            $('input[id="check"]').hide();
            $('input[id="check"]').attr('name', 'ejeInvalido');
            $('input[id="radio"]').show();
            $('input[id="radio"]').attr('name', 'ejes[]');
        }else if(seleccionado == '1'){
            $('input[id="check"]').show();
            $('input[id="check"]').attr('name', 'ejes[]');
            $('input[id="radio"]').hide();
            $('input[id="radio"]').attr('name', 'ejeInvalido');
        }

        if($('#indeterminado').is(':checked')){
            $('select[name="Años"]').attr('disabled', 'disabled');
            $('select[name="Meses"]').attr('disabled', 'disabled');
        }else{
            $('select[name="Años"]').removeAttr('disabled');
            $('select[name="Meses"]').removeAttr('disabled');
        }
    };
    /* Funcion que deshabilita la vigencia en caso de que sea una vigencia indeterminada*/
    function deshabilitarVigencia(){
        if($('#indeterminado').is(':checked')){
            $('select[name="Años"]').attr('disabled', 'disabled');
            $('select[name="Meses"]').attr('disabled', 'disabled');
        }else{
            $('select[name="Años"]').removeAttr('disabled');
            $('select[name="Meses"]').removeAttr('disabled');
        }
        
    };
    window.onload = esconderClasificacion;
    
    $(function() {
        var resoluciones =  <?php echo json_encode($resoluciones); ?>;
        $( "#Resolucion" ).autocomplete({
        source: resoluciones
        });
    } );
</script>
@endsection