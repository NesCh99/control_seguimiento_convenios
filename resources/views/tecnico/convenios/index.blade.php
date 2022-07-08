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
    <div class="core__title">
        <span class="core__title--big">
            Administración de Convenios.
        </span>
        <span class="core__title--small">
            Tabla de Registros
        </span>
        
    </div>    
    <div class="core__content">
        <div class="content__label">
            <span class="label__number">
                1
            </span>
            <span class="label__text">
                Convenios
            </span>
        </div>
        <div class="content__table">
            <table class="tabla display" id="Table__Convenios">
                <div class="button">
                    <a href="{{route('tecnico.convenios.create')}}" class="nav__link nav__link--small">
                        <span class="link__icon--margin">
                            <i class="fa-solid fa-file"></i>
                        </span>
                        Nuevo
                    </a>
                </div>
                <thead>
                    <tr class="col">
                        <th>ID</th>
                        <th>Convenio</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($convenios as $convenio)
                        <tr class="row">
                            <td><b>{{$convenio->idConvenio}}</b></td>
                            <td>{{$convenio->texNombreConvenio}}
                            @if(strcmp($convenio->texUrlConvenio,'Sin Link')!=0)
                                <a href="{{$convenio->texUrlConvenio}}" target="_blank"  class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-file" style="font-size: 18px;"></i>
                                    </span>
                                    <span class="button__table--spam">Ver Documento</span>
                                </a>                                 
                            @endif
                            </td>
                            <td>{{$convenio->datFechaInicioConvenio}}</td>
                            <td>{{$convenio->datFechaFinConvenio}}</td>
                            <?php 
                                $fecha1 = new DateTime($convenio->datFechaFinConvenio); 
                                $fecha2 = new DateTime();
                                $estado = $fecha2->diff($fecha1)->format('%r%y') * 12;
                                if($estado > 0 && $estado > 6){
                                    $estado = 'Vigente';
                                }else if($estado > 0 && $estado <= 6){
                                    $estado = 'Por Caducar';
                                }else{
                                    $estado = 'Caducado';
                                }?>
                            <td>{{$estado}}</td>
                            <td>
                                <a href="{{route('tecnico.convenios.show', $convenio)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a>                                                
                                <a href="{{url('/tecnico/convenios/'.$convenio->idConvenio.'/edit')}}" class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-pen"></i>
                                    </span>
                                    <span class="button__table--spam">Actualizar</span>
                                </a>
                                <button type="button" class="button__table button__table--right">
                                    <span class="icon__button--delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                    </span>
                                    <span class="button__table--spam">Eliminar</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

                