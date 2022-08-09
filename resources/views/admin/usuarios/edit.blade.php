@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Usuarios.
        </span>
        <span class="core__title--small">
            Agregar Usuario
        </span>
    </div>
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <spna class="label__text">
                Usuarios
            </spna>
        </div>
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::model($usuario, ['route' => ['admin.usuarios.update', $usuario], 'method'=>'put', 'class' => 'form']) !!}
                <div class="row--normal">
                    <p>
                        {!! Form::label('Email', 'Email institucional del Usuario') !!}
                        {!! Form::text('Email', $usuario->email, ['class'=>'input form-control', 'placeholder' => 'email@espoch.edu.ec']) !!}
                    </p>
                    @error('Email')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="row--normal">
                    {!! Form::label('Rol', 'Rol') !!}
                    {!! Form::select('roles', $roles, null, ['class'=>'input form-control']) !!}
                    @error('roles')
                        <span class="text-danger">{{$message}}</span>
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