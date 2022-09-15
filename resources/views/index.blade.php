@extends('layouts.convenios')
@section('workArea')
<section class="core">

    <div class="core__title">
        <span class="core__title--big">
            Convenios Interinstitucionales.
        </span>
        <span class="core__title--small">
            Tabla de Registros
        </span>
    </div> 
    <div class="core__content" style="height: 85%;">
        <div class="content__table" style="margin-top: 10px; height: 90%;">
        <div class="labelFecha" style="height: fit-content; margin-bottom: 2em;">
                <span>
                    <h5>
                        Filtrar Desde
                    </h5>
                </span>
            </div>
            <div class="fecha" style="height: fit-content; margin-bottom: 2em;"> 
                <input class="input form-control" type="text" id="min" name="min">
            </div>
            <div class="labelFecha" style="height: fit-content; margin-bottom: 2em;">
                <span>
                    <h5>
                         Hasta
                    </h5>
                </span>
            </div>
            <div class="fecha" style="height: fit-content; margin-bottom: 2em;">
                <input class="input form-control" type="text" id="max" name="max">
            </div>
            <table class="tabla display" id="Table__Convenios">
                <thead>
                    <tr class="col">
                        <th>#</th>
                        <th>Resolución</th>
                        <th>Convenio</th>
                        <th>Objeto del Convenio</th>
                        <th>Coordinador</th>
                        <th>Suscripción</th>
                        <th>Vigencia</th>
                        <!-- <th>Acciones</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($convenios as $numero => $convenio)
                        <tr class="row">
                            <td>{{$numero + 1}}</td>
                            <td><b>{{$convenio->Resolucion}}</b></td>
                            <td>{{$convenio->texNombreConvenio}}
                            <td>{{$convenio->texObjetoConvenio}}</td>
                            <td>
                                @if(is_null($convenio->Coordinador)==false)
                                    {{$convenio->Coordinador->chaCargoCoordinador}}
                                    <br>
                                    {{$convenio->Coordinador->dependencia->vchNombreDependencia}}
                                    <br>
                                    Mediante 
                                    {{$convenio->Coordinador->pivot->chaNombreResolucion}}
                                    @if(is_null($convenio->Delegado)==false)
                                        <br>
                                        Delega a
                                        <br>
                                        {{$convenio->Delegado->chaCargoCoordinador}}
                                        <br>
                                        {{$convenio->Delegado->dependencia->vchNombreDependencia}}
                                        <br>
                                        Mediante 
                                        {{$convenio->Delegado->pivot->chaNombreResolucion}}
                                    @endif
                                @else
                                Sin Coordinador
                                @endif
                            </td>
                            @if(strcmp($convenio->texUrlConvenio,'Sin Link')!=0)
                                <a href="{{$convenio->texUrlConvenio}}" target="_blank"  class="button__table button__table--right">
                                    <span class="icon__button--update">
                                    <i class="fa-solid fa-file" style="font-size: 18px;"></i>
                                    </span>
                                    <span class="button__table--spam">Ver Documento</span>
                                </a>                                 
                            @endif
                            </td>
                            <td>
                                {{$convenio->datFechaInicioConvenio}}
                            </td>
                            <td>
                            {{$convenio->Vigencia}}
                            </td>
                            <!-- <td>
                                <a href="{{route('tecnico.convenios.show', $convenio)}}" class="button__table">
                                    <span class="icon__button--view">
                                    <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="button__table--spam">Ver</span>
                                </a>  
                            </td> -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script>
    var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[5] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#Table__Convenios').DataTable();
  
     // Refilter the table
     $('#min, #max').on('change', function () {
        table.draw();
     });
 });
</script>
@endsection