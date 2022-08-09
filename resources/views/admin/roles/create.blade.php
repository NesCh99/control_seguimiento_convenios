@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Roles.
        </span>
        <span class="core__title--small">
            Agregar Rol
        </span>
    </div>
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <spna class="label__text">
                Roles
            </spna>
        </div>
        <div class="content__form">
            <!-- Formulario de laravel collective -->
            {!! Form::open(['route'=>'admin.roles.store', 'class' => 'form']) !!}
                <div class="row--normal">
                    <p>
                        {!! Form::label('Nombre', 'Nombre del Rol') !!}
                        {!! Form::text('Nombre', null, ['class'=>'input form-control']) !!}
                    </p>
                    @error('Nombre')
                    <span class="text--danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('Permisos', 'Permisos') !!}
                    @foreach($permisos as $permiso)
                        <div>
                            <label>
                                {!! Form::checkbox('permisos[]', $permiso->id, null, ['class'=>'form-control']) !!}
                                {{$permiso->description}}
                            </label>
                        </div>
                    @endforeach
                    @error('permisos')
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