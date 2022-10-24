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
    @error('Tipo')
    <div class="alert alert--danger">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        {{$message}}
    </div>
    @enderror
    <div class="core__title">
        <span class="core__title--big">
            Administración de Convenios.
        </span>
        <span class="core__title--small">
            Actualizar la Información del Convenio
        </span>
    </div>
    <div class="core__content">
        <div class="container__swiper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Editar Información General del Convenio -->
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
                        <div class="content__form">
                            <!-- Formulario de laravel collective -->
                            {!! Form::model($convenio, ['route' => ['tecnico.convenios.update', $convenio], 'method'=>'put']) !!}
                                <!--Content -->
                                <div class="fila">
                                    <span class="fila__label">
                                        Nombre del Convenio
                                    </span>
                                    {!! Form::textarea('Nombre', $convenio->texNombreConvenio, ['class'=>'input form-control', 'style' => 'height:40px;']) !!}
                                    @error('Nombre')
                                    <span class="text--danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="fila">
                                    <span class="fila__label">
                                        Objeto del Convenio
                                    </span>
                                    {!! Form::textarea('Objeto', $convenio->texObjetoConvenio, ['class'=>'input form-control', 'style' => 'height:40px;']) !!}
                                    @error('Objeto')
                                    <span class="text--danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="wrapper">
                                    <div class="fila">
                                        <span class="fila__label">
                                            Resolución de Aprobación del Convenio
                                        </span>
                                        {!! Form::text('Resolucion', $convenio->resolucion->chaNombreResolucion, ['class'=>'input form-control', 'id' => 'Resolucion', 'placeholder'=>'Busque una resolución existente']) !!}
                                        @error('Resolucion')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fila">
                                    <span class="fila__label">
                                        Link del Documento del Convenio
                                    </span>
                                    @if(strcmp($convenio->texUrlConvenio,'Sin Link')==0)
                                        {!! Form::text('Link',null, ['class'=>'input form-control']) !!}
                                    @else
                                        {!! Form::text('Link', $convenio->texUrlConvenio, ['class'=>'input form-control']) !!}
                                    @endif
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
                                        {!! Form::select('idClasificacion', $clasificaciones, null, ['class'=>'input form-control', 'id'=>'Clasificacion', 'onchange'=>'esconderClasificacion()']) !!}       
                                    </div>   
                                    <div class="fila">
                                        <span class="fila__label">
                                            Fecha de Inicio del Convenio
                                        </span>
                                        {{ Form::date('Fecha', $convenio->datFechaInicioConvenio, ['class' => 'input form-control']) }}
                                        @error('Fecha')
                                            <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fila">
                                        <span class="fila__label">
                                            Vigencia: Años
                                        </span>
                                        {{ Form::selectRange('Años', 0, 20, $convenio->años, ['class' => 'input form-control'])}}
                                        @error('Años')
                                            <span class="text--danger">{{$message}}</span>
                                        @enderror
                                        <div class="form-control">
                                        <span class="fila__label">
                                            Indeterminado
                                        </span>
                                        @if(is_null($convenio->datFechaFinConvenio))
                                        {!! Form::checkbox('indeterminado','true', true, ['class'=>'form-control','id'=>'indeterminado', 'onchange' => 'deshabilitarVigencia()']) !!}
                                        @else
                                        {!! Form::checkbox('indeterminado','true', null, ['class'=>'form-control','id'=>'indeterminado', 'onchange' => 'deshabilitarVigencia()']) !!}
                                        @endif
                                        </div>
                                    </div>
                                    <div class="fila">
                                        <span class="fila__label">
                                            Vigencia: Meses
                                        </span>
                                        {{ Form::selectRange('Meses', 0, 11, $convenio->meses, ['class' => 'input form-control'])}}
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
                                                    <input type="checkbox" name="ejes[]" id="check" value="{{ $eje->idEje }}"
                                                    {{ $eje->convenios->contains($convenio->idConvenio) ? 'checked' : '' }}
                                                    @if(in_array($eje->idEje,old('ejes',[]))) checked  @endif>
                                                        
                                                    <input type="radio" name="ejes[]" id="radio" value="{{ $eje->idEje }}"
                                                    {{ $eje->convenios->contains($convenio->idConvenio) ? 'checked' : '' }}
                                                    @if(in_array($eje->idEje,old('ejes',[]))) checked  @endif>
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
                                <p class="block">
                                    <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>    Registrar</span>
                                    </button>
                                </p>
                            {!! Form::close() !!}
                        </div>
                    </div>  
                    
                    <!-- Asignar y Quitar Coordinadores -->                       
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
                        </div>
                        <div class="content_convenio">
                            <div class="wrapper__row-1">
                                <div class="fila">
                                    <span class="fila__label">Coordinadores Asignados</span>
                                    @if(count($convenio->coordinadores)==0)
                                        <p class="fila__text">No posee Coordinadores</p>
                                    @else
                                    <div class="content__table">
                                        <table class="tabla display" id="Table__CoordinadoresAsignados">
                                            <thead>
                                                <tr class="col">
                                                    <th>Coordinador</th>
                                                    <th>Cargo</th>
                                                    <th>Dependencia</th>
                                                    <th>Resolución</th>
                                                    <th>Tipo</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($coordinadoresActuales as $coordinador)
                                                    <tr class="row">
                                                        <td>{{$coordinador->chaNombreCoordinador}}</td>
                                                        <td>{{$coordinador->chaCargoCoordinador}}</td>
                                                        <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                        <td>{{$coordinador->pivot->chaNombreResolucion}}</td>
                                                        <td>{{$coordinador->pivot->chaTipoCoordinador}}</td>
                                                        @if($coordinador->pivot->chaEstadoCoordinador == 'Activo')
                                                        <td><span class="badge badge--info">{{$coordinador->pivot->chaEstadoCoordinador}}</span></td>
                                                        @else
                                                        <td><span class="badge badge--inactive">{{$coordinador->pivot->chaEstadoCoordinador}}</span></td>
                                                        @endif
                                                        <td>
                                                        {!! Form::model($convenio, ['route' => ['tecnico.convenios.quitarCoordinador',$convenio, $coordinador], 'method'=>'put']) !!}
                                                            <button type="submit" class="button__table">
                                                                <span class="icon__button--view">
                                                                    <i class="fa-solid fa-minus" style="font-size: 18px;"></i>
                                                                </span>
                                                                <span class="button__table--spam">Quitar</span>
                                                            </button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                                    @endif
                            </div>
                            <div class="fila">
                                <span class="fila__label" style="margin-bottom: 5px;">Asigne un Nuevo Coordinador</span>     
                                <div class="content__table">
                                            <table class="tabla display" id="Table__Coordinadores">
                                                <thead>
                                                    <tr class="col">    
                                                        <th>Coordinador</th>
                                                        <th>Cargo</th>
                                                        <th>Dependencia</th>
                                                        <th>Tipo</th>
                                                        <th>Resolución</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($coordinadores as $coordinador)
                                                        <tr class="row">
                                                            <td>{{$coordinador->chaTituloCoordinador .' '. $coordinador->chaNombreCoordinador}}</td>
                                                            <td>{{$coordinador->chaCargoCoordinador}}</td>
                                                            <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                            {!! Form::model($convenio, ['route' => ['tecnico.convenios.asignarCoordinador', $convenio, $coordinador], 'method'=>'put']) !!}   
                                                            <td>
                                                                {{Form::select('Tipo', ['Coordinador' => 'Coordinador', 'Delegado' => 'Delegado'], null, ['class'=>'input form-control'])}}
                                                            </td>
                                                            <td>
                                                                @if(count($coordinador->resoluciones)!=0)
                                                                    @foreach($coordinador->resoluciones as $resolucion)
                                                                        {{Form::radio('resolucion'.$coordinador->idCoordinador, $resolucion->chaNombreResolucion, null);}}
                                                                        {{$resolucion->chaNombreResolucion}}
                                                                        <br>
                                                                        <br>
                                                                    @endforeach
                                                                    @error('resolucion'.$coordinador->idCoordinador)
                                                                    <span class="text--danger">Error: No se ha escogido una resolución</span>
                                                                    @enderror
                                                                @else
                                                                    Aún no se asignan resoluciones
                                                                @endif
                                                            </td>
                                                            <td>              
                                                                @if(count($coordinador->resoluciones)!=0)                                     
                                                                <button type="submit" class="button__table">
                                                                    <span class="icon__button--view">
                                                                        <i class="fa-solid fa-plus" style="font-size: 18px;"></i>
                                                                    </span>
                                                                    <span class="button__table--spam">Asignar</span>
                                                                </button>
                                                                @endif
                                                            {!! Form::close() !!}
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
@section('css')
@endsection
@section('js')
<script>
$( function() {
    var resoluciones =  <?php echo json_encode($resoluciones); ?>;
    $( "#Resolucion" ).autocomplete({
    source: resoluciones
    });
} );
</script>
<script>
    /* Funcion que esconde los ejes en caso de ser internacional cuando se carga la página*/
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
    $(function() {
        var resoluciones =  <?php echo json_encode($resoluciones); ?>;
        $( "#Resolucion" ).autocomplete({
        source: resoluciones
        });
    } );
    window.onload = esconderClasificacion;
</script>
@endsection