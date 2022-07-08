@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
            Administración de Coordinadores.
        </span>
        <span class="core__title--small">
            Agregar Coordinador
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
                            <div class="content__form">
                                <!-- Formulario de laravel collective -->
                                {!! Form::open(['route'=>'tecnico.coordinadores.store', 'class' => 'form']) !!}
                                    <p>
                                        {!! Form::label('Nombre', 'Nombre Completo') !!}
                                        {!! Form::text('Nombre', null, ['class'=>'input form-control']) !!}
                                        @error('Nombre')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Cargo', 'Cargo del Coordinador') !!}
                                        {!! Form::text('Cargo', null, ['class'=>'input form-control']) !!}
                                        @error('Cargo')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Titulo', 'Titulo del Coordinador') !!}
                                        {!! Form::text('Titulo', null, ['class'=>'input form-control']) !!}
                                        @error('Titulo')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Celular', 'Celular del Coordinador') !!}
                                        {!! Form::text('Celular', null, ['class'=>'input form-control']) !!}
                                        @error('Celular')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>
                                    <p>
                                        {!! Form::label('Dependencia', 'Dependencia') !!}
                                        <select name="Dependencia" id="Dependencia" class="form-select">
                                            @foreach($dependencias as $dependencia)
                                                <option value="{{$dependencia->idDependencia}}">{{$dependencia->vchNombreDependencia}}</option>
                                            @endforeach
                                        </select>
                                        @error('Dependencia')
                                        <span class="text--danger">{{$message}}</span>
                                        @enderror
                                    </p>

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
        </div>
    </div>
</section>
@endsection