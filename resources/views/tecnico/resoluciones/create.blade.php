@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Resoluciones.
        </span>
        <span class="core__title--small">
            Agregar Resolucion
        </span>
    </div>
    <div class="core__content">
        <div class="labels">
            <div class="label label--next">
                <span class="label__number">1</span>
                <span class="label__text">Información General</span>
            </div>
        </div>
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::open(['route'=>'tecnico.resoluciones.store', 'class' => 'form']) !!}
                <p>
                    {!! Form::label('Nombre', 'Nombre de la Resolucion') !!}
                    {!! Form::text('Nombre', null, ['class'=>'input form-control']) !!}
                    @error('Nombre')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </p>
                <p>
                    {!! Form::label('Tipo', 'Tipo de Resolucion') !!}
                    <select name="Tipo" id="Tipo" class="input form-control">
                        <option value="1">Resolución</option>
                        <option value="2">Oficio</option>
                    </select>
                </p>                
                <p class="block">
                    <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>    Registrar</span>
                    </button>
                </p>
            {!! Form::close() !!}
        </div>
    </div>
</section>

@endsection