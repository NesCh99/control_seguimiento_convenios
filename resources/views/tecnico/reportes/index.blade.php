@extends('layouts.convenios')
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
			<div class="tipo estadistica--click tipo--big">
				<span class="label__matriz">
				<i class="fa-solid fa-chart-column"></i>  Gráficos Estadísticos
				</span>
			</div>
		</div>
		<div class="reporte__content">
			<div class="overlay__matriz overlay--active">
				<table class="tabla display" id="Table__Matriz">
					<div class="button button--excel" id="exportar__excel">
						<span  class="nav__link nav__link--small nav__link--white">
						<span class="link__icon--margin">
						<i class="fa-solid fa-file"></i>
						</span>
						Exportar Excel
						</span>
					</div>
					<thead>
						<tr class="col">
							<th>ID</th>
							<th>Convenio</th>
							<th>Coordinadores</th>
							<th>Fecha de Inicio</th>
							<th>Fecha de Fin</th>
							<th>Estado</th>
							<th>Resolución</th>
							<th>Criterio Parcial</th>
							<th>Cumplimiento Parcial</th>
							<th>Crtiterio Total</th>
							<th>Cumplimiento Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($conveniosTotales as $convenio)
						<tr class="row">
							<td><b>{{$convenio->idConvenio}}</b></td>
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
									<p class="text-sm mb-0">{{$coordinador->chaTituloCoordinador }}<span> </span> {{$coordinador->chaNombreCoordinador}}   </br>
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
								if($estado > 0 && $estado > 6){
								    $estado = 'Vigente';
								}else if($estado > 0 && $estado <= 6){
								    $estado = 'Por Caducar';
								}else{
								    $estado = 'Caducado';
								}?>
							<td>{{$estado}}</td>
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
							<?php
								$fechaInicio = date_create($convenio->datFechaInicioConvenio);
								$fechaFin = date_create($convenio->datFechaFinConvenio);
								$fechaAhora = date_create(date('Y-m-d'));
								$criterioParcial = round((date_diff($fechaInicio,$fechaAhora)->days)/30);
								$criterioParcial = floor($criterioParcial/6);
								$criterioTotal = round((date_diff($fechaInicio,$fechaFin)->days)/30);
								$criterioTotal = floor($criterioTotal/6);
								$nInformesPresentados = count($convenio->informes->where('chaEstadoInforme','Presentado'));
								if($nInformesPresentados==0){
									$cumplimientoParcial = 0;
									$cumplimientoTotal = 0;
								}else{
									$cumplimientoParcial = ($nInformesPresentados/$criterioParcial)*100;
									$cumplimientoTotal = ($nInformesPresentados/$criterioTotal)*100;
								} ?>
							<td>{{$criterioParcial}}</td>
							<td>{{$cumplimientoParcial}}</td>
							<td>{{$criterioTotal}}</td>
							<td>{{$cumplimientoTotal}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="overlay_estaditica">
				<div class="graphs">
					<di class="graph__box">
						<div class="graph__label">
							<h5>Número total de convenios vigentes por clasificación</h5>
						</div>
						<div class="graph">
							<canvas class="canvas" id="graph1">
							</canvas>
							<div class="button button--excel bg-info" id="exportar__grafico--1">
								<span  class="nav__link nav__link--small nav__link--white">
								<span class="link__icon--margin">
								<i class="fa-solid fa-file"></i>
								</span>
								Exportar Imágen
								</span>
							</div>
						</div>
					</di>
					
      
					<di class="graph__box">
						<div class="graph__label graph__label--year ">
							<h5>Nivel de Cumplimineto Parcial de los  convenios por clasificación y por año.
							@foreach($convenioCumplimiento as $convenioNivel)
							
@endforeach

                         
							
							<form class="form-inline" method="POST" action="{{route('tecnico.reporte')}}">
										@csrf
										<div class="form-group mx-sm-3 mb-2">
										{{ Form::selectRange('Años', 2015, 2022, null, ['class' => 'input form-control'])}}
										</div>
							            </br>
										<button type="submit" class="btn btn-primary mb-2">Generar Gráfico</button>
										</br>
							</form>
							</h5>
						</div>

					
						<div class="graph">
							<canvas class="canvas" id="graph2">
							</canvas>
							<div class="button button--excel" id="exportar__grafico--2">
								<span  class="nav__link nav__link--small nav__link--white">
								<span class="link__icon--margin">
								<i class="fa-solid fa-file"></i>
								</span>
								Exportar Imágen
								</span>
							</div>
						</div>
					</di>

					<di class="graph__box">
						<div class="graph__label graph__label--year ">
							<h5>Nivel de Cumplimineto Total  de los convenios por clasificación y por año
						

                         
							
							<form class="form-inline" method="POST" action="{{route('tecnico.reporte')}}">
										@csrf
										<div class="form-group mx-sm-3 mb-2">
											
										<input type="text" id="name" name="name" required
                                         minlength="4" maxlength="4" size="10">
										</div>
							            </br>
										<button type="submit" class="btn btn-primary mb-2">Generar Gráfico</button>
										</br>
							</form>
							</h5>
						</div>

					
						<div class="graph">
							<canvas class="canvas" id="graph3">
							</canvas>
							<div class="button button--excel" id="exportar__grafico--3">
								<span  class="nav__link nav__link--small nav__link--white">
								<span class="link__icon--margin">
								<i class="fa-solid fa-file"></i>
								</span>
								Exportar Imágen
								</span>
							</div>
						</div>
					</di>


				</div>
			</div>
		</div>
	</div>
	<?php
		?>
</section>
@endsection
@section('js')
<script src="js/reporte.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script >
	document.getElementById('exportar__excel').addEventListener('click',function(){
	    var table2excel = new Table2Excel();
	    table2excel.export(document.querySelectorAll("#Table__Matriz"));
	});
</script> 
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
	const btnImagen = document.querySelector("#exportar__grafico--1");
	const imagen1 = document.querySelector("#graph1");
	const btnImagen2 = document.querySelector("#exportar__grafico--2");
	const imagen2 = document.querySelector("#graph2");
	const btnImagen3 = document.querySelector("#exportar__grafico--3");
	const imagen3 = document.querySelector("#graph3");

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




	
</script>
@endsection