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
                                <span class="label__text">Resoluciones</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
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
                                <div class="wrapper wrapper__row-4">
                                    <div class="fila">
                                        <span class="fila__label">
                                            Clasificación
                                        </span>
                                        {!! Form::select('idClasificacion', $clasificaciones, null, ['class'=>'input form-control', 'name'=>'idClasificacion', 'id'=>'idClasificacion']) !!}       
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
                                        <?php 
                                        $fecha1 = new DateTime($convenio->datFechaInicioConvenio); 
                                        $fecha2 = new DateTime($convenio->datFechaFinConvenio);
                                        $años = $fecha1->diff($fecha2)->format('%r%y');?>
                                        {{ Form::selectRange('Años', 0, 12, $años, ['class' => 'input form-control'])}}
                                        @error('Años')
                                            <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="fila">
                                        <span class="fila__label">
                                            Vigencia: Meses
                                        </span>
                                        <?php 
                                        $meses = $años*12;?>
                                        {{ Form::selectRange('Meses', 0, 11, $meses, ['class' => 'input form-control'])}}
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
                                                    <input type="checkbox" name="ejes[]" value="{{ $eje->idEje }}"
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
                    <!-- Asignar y Quitar Resoluciones -->    
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
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">3</span>
                                <span class="label__text">Coordinadores</span>
                            </div>
                        </div>
                        <div class="content_convenio">
                            <div class="wrapper__row-1">
                                <div class="fila">
                                    <span class="fila__label">Resoluciones Asignadas</span>
                                    @if(count($convenio->resoluciones)==0)
                                        <p class="fila__text">No posee Resoluciones</p>
                                    @else
                                    <div class="content__table">
                                        <table class="tabla display" id="Table__ResolucionesAsignadas">
                                            <thead>
                                                <tr class="col">
                                                    <th>Resolucion</th>
                                                    <th>Tipo</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($convenio->resoluciones as $resolucion)
                                                    <tr class="row">
                                                        <td>{{$resolucion->chaNombreResolucion}}</td>
                                                        @if($resolucion->sinTipoResolucion == 1)
                                                        <td>Resolución</td>
                                                        @else
                                                        <td>Oficio</td>
                                                        @endif
                                                        <td>
                                                        {!! Form::model($convenio, ['route' => ['tecnico.convenios.quitarResolucion',$convenio, $resolucion], 'method'=>'put']) !!}
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
                                    @endif
                                </div>     
                            </div>
                            <div class="fila">
                                <span class="fila__label" style="margin-bottom: 5px;">Asigne una Nueva Resolución</span>     
                                <div class="content__table">
                                    <table class="tabla display" id="Table__Resoluciones">
                                        <thead>
                                            <tr class="col">    
                                                <th>Resolucion</th>
                                                <th>Tipo</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($resoluciones2 as $resolucion)
                                                <tr class="row">
                                                    <td>{{$resolucion->chaNombreResolucion}}</td>
                                                    @if($resolucion->sinTipoResolucion == 1)
                                                    <td>Resolución</td>
                                                    @else
                                                    <td>Oficio</td>
                                                    @endif
                                                    <td>
                                                    {!! Form::model($convenio, ['route' => ['tecnico.convenios.asignarResolucion', $convenio, $resolucion], 'method'=>'put']) !!}                                                               
                                                        <button type="submit" class="button__table">
                                                            <span class="icon__button--view">
                                                                <i class="fa-solid fa-plus" style="font-size: 18px;"></i>
                                                            </span>
                                                            <span class="button__table--spam">Asignar</span>
                                                        </button>
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
                    <!-- Asignar y Quitar Coordinadores -->                       
                    <div class="swiper-slide">
                        <div class="labels">
                            <div class="label label--disable">
                                <span class="label__number  label__number--disable">1</span>
                                <span class="label__text">Información General</span>
                            </div>
                            <div class="label label--next label--disable">
                                <span class="label__number label__number--disable">2</span>
                                <span class="label__text">Resoluciones</span>
                            </div>
                            <div class="label label--next">
                                <span class="label__number">3</span>
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
                                                    <th>Tipo</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($convenio->coordinadores as $coordinador)
                                                    <tr class="row">
                                                        <td>{{$coordinador->chaTituloCoordinador .' '. $coordinador->chaNombreCoordinador}}</td>
                                                        <td>{{$coordinador->chaCargoCoordinador}}</td>
                                                        <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                        <td>{{$coordinador->pivot->chaEstadoCoordinador}}</td>
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
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($coordinadores as $coordinador)
                                                        @foreach($convenio->resoluciones as $resolucion)
                                                            @foreach($coordinador->resoluciones as $resolucion2)
                                                                @if($resolucion->idResolucion == $resolucion2->idResolucion)
                                                                    <tr class="row">
                                                                        <td>{{$coordinador->chaTituloCoordinador .' '. $coordinador->chaNombreCoordinador}}</td>
                                                                        <td>{{$coordinador->chaCargoCoordinador}}</td>
                                                                        <td>{{$coordinador->dependencia->vchNombreDependencia}}</td>
                                                                        <td>
                                                                        {!! Form::model($convenio, ['route' => ['tecnico.convenios.asignarCoordinador', $convenio, $coordinador], 'method'=>'put']) !!}                                                               
                                                                            <button type="submit" class="button__table">
                                                                                <span class="icon__button--view">
                                                                                    <i class="fa-solid fa-plus" style="font-size: 18px;"></i>
                                                                                </span>
                                                                                <span class="button__table--spam">Asignar</span>
                                                                            </button>
                                                                        {!! Form::close() !!}
                                                                        </td>
                                                                    </tr> 
                                                                @endif                                                                
                                                            @endforeach
                                                        @endforeach
                                                                                                           
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
    /* Funcion que esconde los ejes cuando se escoge la clasificación internacional en el select */
    $('#idClasificacion').on('change', function(){
        var seleccionado = $("#idClasificacion option:selected" ).text();
        
        if(seleccionado == 'Internacional'){
            $('.campoEjes').hide();
        }else{
            $('.campoEjes').show();
        }
    });
    /* Funcion que esconde los ejes en caso de ser internacional cuando se carga la página*/
    function esconder(){
        var seleccionado = $("#idClasificacion option:selected" ).text();
        
        if(seleccionado == 'Internacional'){
            $('.campoEjes').hide();
        }else{
            $('.campoEjes').show();
        }
    };
    window.onload = esconder;
</script>
@endsection