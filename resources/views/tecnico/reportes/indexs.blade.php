@extends('layouts.convenios')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/styleReportes.css')}}">
@endsection
@section('workArea')
<section class="core">
	<div class="core__title core__title-small">
		<span class="core__title--big">
		Administración de Convenios.
		</span>
		<span class="core__title--small">
		Reportes
		</span>
	</div>
	<div class="core__content core__content--big">
		<div class="reporte__tipo">
			<div class="tipo matriz--click lock">
				<span class="label__matriz">
				<i class="fa-solid fa-file-csv"></i>   Matriz
				</span>
			</div>
			<div class="tipo estadistica--click tipo--big ">
				<span class="label__matriz"><i class="fa-solid fa-chart-column"></i>Convenios Vigentes</span>
			</div>
			<div class="tipo estadistica--click tipo--big caducado--click">
				<span class="label__matriz"><i class="fa-solid fa-chart-column"></i>Convenios Caducados</span>
			</div>
		</div>
		<div class="reporte__content">
			<div class="overlay__matriz overlay--active">
           <div class="fixed">

		
			<form  method="POST" action="{{route('tecnico.reporte')}}">
			@csrf
				<button type="submit" class="button  export">
					<span  class="nav__link nav__link--small nav__link--white">
					<span class="link__icon--margin">
					<i class="fa-solid fa-filter"></i>
					</span>
					Filtrar
					</span>
				</button >
				<div class="buttonFecha">
					<div class="labelFecha">
						<span>
							<h5>
								Hasta
							</h5>
						</span>
					</div>
					<div class="fecha">
						{{ Form::date('hasta', null, ['class' => 'input form-control']) }}
						@error('hasta')
						<span class="text--danger">{{$message}}</span>
						@enderror
					</div>
				</div>
				<div class="buttonFecha">
					<div class="labelFecha">
						<span>
							<h5>
								Desde
							</h5>
						</span>
					</div>
					<div class="fecha">
						{{ Form::date('desde', null, ['class' => 'input form-control']) }}
						@error('desde')
						<span class="text--danger">{{$message}}</span>
						@enderror
					</div>
				</div>
			</form>
   </div>
				<table class="tabla display" id="Table__Matriz">
					<div class="button button--excel" id="exportar__excel"></div>
					<thead>
						<tr class="col">
							<th class="visble">ID</th>
							<th>Resolución</th>
							<th>Convenio</th>
							<th>Coordinadores</th>
							<th>Fecha de Inicio</th>
							<th>Fecha de Fin</th>
							<th>Estado</th>
							<th>Criterio Parcial</th>
							<th>Cumplimiento Parcial</th>
							<th>Crtiterio Total</th>
							<th>Cumplimiento Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($conveniosTotales as $convenio)
						<tr class="row">
							<td class="visble"><b>{{$convenio->idConvenio}}</b></td>
							<td>
								<div class="ms-4 my-auto">
									@foreach($convenio->Coordinadores as $coordinador)
									@foreach($coordinador->Resoluciones as $resolucion)
									@if($resolucion->sinTipoResolucion ==1)
									<h4>{{$resolucion->chaNombreResolucion}}</h4>
									@endif
									@endforeach
									@endforeach
								</div>
							</td>
							<td>
								<p class="text-center">   {{$convenio->texNombreConvenio}} </p>
							</td>
							<td>
								<div class="ms-4 my-auto">
									@foreach($convenio->Coordinadores as $coordinador)
									@foreach($coordinador->Resoluciones as $resolucion)
									@if($resolucion->sinTipoResolucion ==1)
									<h4>Coordinador</h4>
									@else
									<h4>Delegado</h4>
									@endif
									<p class="text-sm mb-0"><span>{{$coordinador->chaTituloCoordinador }}{{$coordinador->chaNombreCoordinador}} </span>    </br>
										@if($resolucion->sinTipoResolucion ==1)
										<span>Mediante la resolución </span>
										@else
										<span>Mediante el oficio</span>
										@endif
										{{$resolucion->chaNombreResolucion}}
									</p>
									@endforeach
									@endforeach
								</div>
							</td>
							<td>{{$convenio->datFechaInicioConvenio}}</td>
							<td>{{$convenio->datFechaFinConvenio}}</td>
							<?php
								$fecha1 = new DateTime($convenio->datFechaFinConvenio);
								$fecha2 = new DateTime();
								$estado = $fecha2->diff($fecha1)->format('%r%y') * 12;
								if ($estado > 0 && $estado > 6) {
								    $estado = 'Vigente';
								} else if ($estado > 0 && $estado <= 6) {
								    $estado = 'Por Caducar';
								} else {
								    $estado = 'Caducado';
								}?>
							<td>{{$estado}}</td>
							<?php
								$fechaInicio = date_create($convenio->datFechaInicioConvenio);
								$fechaFin = date_create($convenio->datFechaFinConvenio);
								$fechaAhora = date_create(date('Y-m-d'));
								$criterioParcial = round((date_diff($fechaInicio, $fechaAhora)->days) / 30);
								$criterioParcial = floor($criterioParcial / 6);
								$criterioTotal = round((date_diff($fechaInicio, $fechaFin)->days) / 30);
								$criterioTotal = floor($criterioTotal / 6);
								$nInformesPresentados = count($convenio->informes->where('chaEstadoInforme', 'Presentado'));
								if ($nInformesPresentados == 0) {
								    $cumplimientoParcial = 0;
								    $cumplimientoTotal = 0;
								} else {
								    $cumplimientoParcial = ($nInformesPresentados / $criterioParcial) * 100;
								    $cumplimientoTotal = ($nInformesPresentados / $criterioTotal) * 100;
								}?>
							<td>{{$criterioParcial}}</td>
							<td>{{$cumplimientoParcial}} %</td>
							<td>{{$criterioTotal}}</td>
							<td>{{$cumplimientoTotal}} %</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			
			</div>
			<div class="overlay_estaditica">
				@include('tecnico.reportes.graficos.graficosVigentes')
			</div>
			<div class="overlay_estaditica caducado_overlay--click">
				@include('tecnico.reportes.graficos.graficosCaducados')
			</div>
		</div>
	</div>
	<?php
		$convenioMarcoGraph = json_encode(count($convenioMarco))
		?>
</section>
@endsection
@section('js')
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script src="{{asset('js/reportes/matriz/matrizGeneral.js')}}"></script>
<!--Gráficos  -->
<script >

	let graph1=document.getElementById("graph1").getContext("2d");
	var char = new Chart(graph1,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Clasificación de Convenios Insitucionales',
	            data: [{{count($convenioMarco)}}, {{count($convenioEspecifico)}}, {{count($convenioInternacional)}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
	
	
	
	
	let graph2=document.getElementById("graph2").getContext("2d");
	var char = new Chart(graph2,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Nivel de Cumplimineto Parcial',
	            data: [{{$cumplimientoMarcoParcial}}, {{$cumplimientoEspecificoParcial}}, {{$cumplimientoInternacionalParcial}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	                
	                
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
	
	
	let graph3=document.getElementById("graph3").getContext("2d");
	var char = new Chart(graph3,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Nivel de Cumplimineto Total',
	            data: [{{$cumpliminetoMarcoTotal}}, {{$cumplimientoEspecificoTotal}}, {{$cumplimientoInternacionalTotal}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	                
	                
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
</script>
<script>
	var marcoEspecificoCaducado = {{count($convenioMarcoCaducado)}}+{{count($convenioEspecificoCaducado)}};
	let graph4=document.getElementById("graph4").getContext("2d");
	var char = new Chart(graph4,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco y Específico', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Clasificacion de convenidos caducados',
	            data: [marcoEspecificoCaducado, {{count($convenioEspecificoCaducado)}}, {{count($convenioInternacionalCaducado)}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	                
	                
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
	
	let graph5=document.getElementById("graph5").getContext("2d");
	var char = new Chart(graph5,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Nivel de Cumplimineto Parcial',
	            data: [{{$cumplimientoMarcoParcialCaducado}}, {{$cumplimientoEspecificoParcialCaducado}}, {{$cumplimientoInternacionalParcialCaducado}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	                
	                
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
	
	
	
	let graph7=document.getElementById("graph7").getContext("2d");
	var char = new Chart(graph7,{
	  type: 'bar',
	    data: {
	        labels: ['Convenio Marco', 'Convenio Específico', 'Convenio Internacional'],
	        datasets: [{
	            label: 'Nivel de Cumplimineto Total',
	            data: [{{$cumpliminetoMarcoTotalCaducado}}, {{$cumplimientoEspecificoTotalCaducado}}, {{$cumplimientoInternacionalTotalCaducado}}],
	            backgroundColor: [
	                'rgba(13,25,191,0.2)',
					
	                'rgba(54, 162, 235, 0.2)',
	                'rgba(255, 206, 86, 0.2)'
	                
	                
	            ],
	            borderColor: [
	                'rgba(13,25,191,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)'
	               
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }, 
	        },
			plugins: {
	     datalabels: {
	     }
	   }
	    },
		plugins:[ChartDataLabels]
	});
	
	
	
</script>
<script>
	const btnImagen = document.querySelector("#exportar__grafico--1");
	const imagen1 = document.querySelector("#graph1");
	const btnImagen2 = document.querySelector("#exportar__grafico--2");
	const imagen2 = document.querySelector("#graph2");
	const btnImagen3 = document.querySelector("#exportar__grafico--3");
	const imagen3 = document.querySelector("#graph3");
	
	
	
	const btnImagen4 = document.querySelector("#exportar__grafico--4");
	const imagen4 = document.querySelector("#graph4");
	const btnImagen5 = document.querySelector("#exportar__grafico--5");
	const imagen5 = document.querySelector("#graph5");
	
	const btnImagen6 = document.querySelector("#exportar__grafico--6");
	const imagen6 = document.querySelector("#graph7");
	
	
	
	
	
	btnImagen.addEventListener("click", function(){
	
	  if(window.navigator.msSaveBlob){
	     window.navigator.msSaveBlob(imagen1.msToBlob(),"convenios-clasificacion.png");
	  }else{
	    const a = document.createElement("a");
		a.href= imagen1.toDataURL();
		a.download ="convenios-clasificacion.png";
		a.click();
	  }
	});
	

	btnImagen2.addEventListener("click", function(){
	
	if(window.navigator.msSaveBlob){
	   window.navigator.msSaveBlob(imagen2.msToBlob(),"nivel-cumplimineto-parcial.png");
	}else{
	  const a = document.createElement("a");
	  a.href= imagen2.toDataURL();
	  a.download ="nivel-cumplimineto-parcial.png";
	  a.click();
	}
	 });

	btnImagen3.addEventListener("click", function(){
	
	if(window.navigator.msSaveBlob){
	   window.navigator.msSaveBlob(imagen3.msToBlob(),"nivel-cumplimineto-total.png");
	}else{
	  const a = document.createElement("a");
	  a.href= imagen3.toDataURL();
	  a.download ="nivel-cumplimineto-total.png";
	  a.click();
	}
	 });
	
	 btnImagen4.addEventListener("click", function(){
	
	if(window.navigator.msSaveBlob){
	   window.navigator.msSaveBlob(imagen4.msToBlob(),"convenios-caducados.png");
	}else{
	  const a = document.createElement("a");
	  a.href= imagen4.toDataURL();
	  a.download ="convenios-caducados.png";
	  a.click();
	}
	 });
	
	
	
	
	
	
	
	 btnImagen5.addEventListener("click", function(){
	
	if(window.navigator.msSaveBlob){
	   window.navigator.msSaveBlob(imagen5.msToBlob(),"nivel-cumplimineto-Parcial-caducado.png");
	}else{
	  const a = document.createElement("a");
	  a.href= imagen5.toDataURL();
	  a.download ="nivel-cumplimineto-Parcial-caducado.png";
	  a.click();
	}
	 });

	 btnImagen6.addEventListener("click", function(){
	
	if(window.navigator.msSaveBlob){
	   window.navigator.msSaveBlob(image6.msToBlob(),"nivel-cumplimineto-total-caducado.png");
	}else{
	  const a = document.createElement("a");
	  a.href= imagen6.toDataURL();
	  a.download ="nivel-cumplimineto-total-caducado.png";
	  a.click();
	}
	 });
	
	
	
	
	
	
	
	
	
</script>
@endsection