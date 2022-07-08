@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Dependencias.
        </span>
        <span class="core__title--small">
            Actualizar la información de la Dependencia
        </span>
    </div>
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <span class="label__text">
                Dependencias
            </span>
        </div>
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::model($dependencia, ['route' => ['admin.dependencias.update', $dependencia], 'method'=>'put', 'class' => 'form']) !!}
                <div class="row--normal">
                    <p>
                        {!! Form::label('Nombre', 'Nombre de la Dependencia') !!}
                        {!! Form::text('Nombre', $dependencia->vchNombreDependencia, ['class'=>'input form-control']) !!}
                    </p>
                    @error('Nombre')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </div>    
                <p class="block">
                    <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span> Actualizar</span>
                    </button>
                </p>               
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection