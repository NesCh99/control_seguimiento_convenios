@extends('layouts.convenios')
@section('workArea')

<section class="core">
    <div class="content">
        <div class="alert alert-info alert-dismissable mt-2" >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Bienvenido!</strong> al Sistema de Control y Seguimiento de Convenios Interinstitucionales
        </div> 
    </div>
    <div class="content" style="margin-bottom: 5%; margin-top: 2%;">
        <div id="accordion">
            <div class="card" data-toggle="tooltip" data-placement="bottom" title="Se muestran primero los convenios más cercanos a caducar">
                <div class="btn btn-light" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">              
                    <div class="rowBootstrap p-2">
                        <div class="col-md-11 text-left">
                            <strong>Convenios Próximos a Caducar</strong>
                            @if($conveniosNuevos != 0)
                            <span class="badge badge-warning ml-2" style="color: white;">
                                {{$conveniosNuevos}} Nuevo
                            </span>
                            @endif
                        </div>
                        <div class="col-md-1 text-center">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @if(is_null($conveniosPorCaducar) == false)
                        @foreach($conveniosPorCaducar as $convenio)
                            <div class="alert alert-warning">
                                <div class="rowBootstrap">
                                    <div class="col-md-2">
                                        En {{$convenio->meses}}
                                        <strong>{{$convenio->datFechaFinConvenio}}</strong>
                                    </div>
                                    <div class="col-md-9 text-justify">
                                        <strong>{{$convenio->texNombreConvenio}}</strong>
                                    </div> 
                                    <div class="col-md-1 text-center">
                                        <a href="{{route('tecnico.convenios.show', $convenio)}}" target="_blank">
                                        <button class="btn btn-outline-info"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card" data-toggle="tooltip" data-placement="bottom" title="Se muestran los convenios que caducaron desde el inicio de mes hasta hoy">
                <div class="btn btn-light" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">              
                    <div class="rowBootstrap p-2">
                        <div class="col-md-11 text-left">
                            <strong>Convenios Caducados</strong>
                            <span class="badge badge-danger ml-2" style="color: white;">
                                {{count($conveniosCaducados)}} Total
                            </span>
                        </div>
                        <div class="col-md-1 text-center">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        @if(is_null($conveniosCaducados) == false)
                        @foreach($conveniosCaducados as $convenio)
                            <div class="alert alert-danger">
                                <div class="rowBootstrap">
                                    <div class="col-md-2">
                                        Caducó el
                                        <strong>{{$convenio->datFechaFinConvenio}}</strong>
                                    </div>
                                    <div class="col-md-9 text-justify">
                                        <strong>{{$convenio->texNombreConvenio}}</strong>
                                    </div> 
                                    <div class="col-md-1 text-center">
                                        <a href="{{route('tecnico.convenios.show', $convenio)}}" target="_blank">
                                        <button class="btn btn-outline-info"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="card" data-toggle="tooltip" data-placement="bottom" title="Se muestran los informes pendientes de convenios vigentes">
                <div class="btn btn-light" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">              
                    <div class="rowBootstrap p-2">
                        <div class="col-md-11 text-left">
                            <strong>Informes Pendientes</strong>
                            @if($informesNuevos != 0)
                            <span class="badge badge-secondary ml-2" style="color: white;">
                                {{$informesNuevos}} Nuevo
                            </span>
                            @endif
                        </div>
                        <div class="col-md-1 text-center">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        @if(is_null($informesPendientes) == false)
                            @foreach($informesPendientes as $informe)
                                <div class="alert alert-info">
                                    <div class="rowBootstrap">
                                        <div class="col-md-2">
                                            Del
                                            <strong>{{$informe->datFechaInicioInforme}}</strong>
                                            Al
                                            <strong>{{$informe->datFechaFinInforme}}</strong>
                                        </div>
                                        <div class="col-md-9 text-justify">
                                            <strong>{{$informe->convenio->texNombreConvenio}}</strong>
                                        </div> 
                                        <div class="col-md-1 text-center">
                                            <a href="{{route('tecnico.convenios.show', $informe->convenio->idConvenio)}}" target="_blank">
                                            <button class="btn btn-outline-info"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                            </a>
                                        </div>                            
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section ('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.rowBootstrap {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}
</style>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


@endsection