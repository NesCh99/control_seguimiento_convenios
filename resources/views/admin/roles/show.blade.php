
@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <div class="core__title">
        <span class="core__title--big">
               Roles y Permisos
        </span>
        <span class="core__title--small">
            Información General del Rol
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
    
         <!--Información General -->
                    <div class="content_convenio">
                        <div class="wrapper">
                            <div class="fila">
                                <span class="fila__label">Nombre del Rol</span>
                                <p class="fila__text">{{$rol->name}}</p>
                            </div>
                            <div class="fila">
                                <span class="fila__label">Permisos</span>
                                @foreach($permisos as $permiso)
                                <p class="fila__text"><b>♦</b> {{$permiso->description}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>
    
</section>

@endsection