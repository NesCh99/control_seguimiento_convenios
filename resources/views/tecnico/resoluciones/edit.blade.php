@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Resoluciones.
        </span>
        <span class="core__title--small">
            Actualizar la información de la Resolucion
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
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::model($resolucion, ['route' => ['tecnico.resoluciones.update', $resolucion], 'method'=>'put', 'class' => 'form']) !!}
                <p>
                    {!! Form::label('Nombre', 'Nombre de la Resolucion') !!}
                    {!! Form::text('Nombre', $resolucion->chaNombreResolucion, ['class'=>'input form-control']) !!}
                    @error('Nombre')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </p>
                <p>
                    {!! Form::label('Link', 'Link del Documento de la Resolucion') !!}
                    @if(strcmp($resolucion->texUrlResolucion,'Sin Link')==0)
                        {!! Form::text('Link',null, ['class'=>'input form-control']) !!}
                    @else
                        {!! Form::text('Link', $resolucion->texUrlResolucion, ['class'=>'input form-control']) !!}
                    @endif
                    @error('Link')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </p>
                <p>
                    {!! Form::label('Tipo', 'Tipo de Resolucion') !!}
                    <select name="Tipo" id="Tipo" class="input form-control">
                        @if($resolucion->sinTipoResolucion == 1)
                            <option value="1" selected>Resolución</option>
                            <option value="2">Oficio</option>
                        @else
                            <option value="1">Resolución</option>
                            <option value="2" selected>Oficio</option>
                        @endif
                    </select>
                </p>
                <p>
                    {!! Form::label('Objeto', 'Objeto de la Resolucion') !!}
                    {!! Form::textarea('Objeto', $resolucion->texObjetoResolucion, ['class'=>'input form-control']) !!}
                    @error('Objeto')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </p>

                <p class="block">
                    <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>Registrar</span>
                    </button>
                </p>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection