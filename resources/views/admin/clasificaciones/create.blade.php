@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Clasificaciones.
        </span>
        <span class="core__title--small">
            Agregar Clasificación
        </span>
    </div>
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <spna class="label__text">
                Clasificaciones
            </spna>
        </div>
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::open(['route'=>'admin.clasificaciones.store', 'class' => 'form']) !!}   
            <div class="row--normal">
                <p>
                    {!! Form::label('Clasificacion', 'Nombre de la Clasificación') !!}
                    {!! Form::text('Nombre', null, ['class'=>'input form-control']) !!}
                </p> 
                @error('Nombre')
                    <span class="text--danger">{{$message}}</span>
                @enderror 
            </div>    
                        
            <p class="block">
                <button type="submit" class="button button--rigth "><span>  <i class="fa-solid fa-file-arrow-down"></i> <span> </span>    Registrar</span>
                </button>
            </p>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection