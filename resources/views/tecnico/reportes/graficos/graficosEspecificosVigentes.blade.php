<div class="filtro">
	<div class="filtro__vigente">
		<h5>Seleccione el año para filtrar los convenios vigentes </h5>
		</br>
		<form  method="POST" action="{{route('tecnico.reporte')}}">
			<div class="filtro__year">
				@csrf
				{{ Form::select('Años', array('' => 'Todos') + array_combine(range($fechaVigenteMin,$fechaVigenteMax),range($fechaVigenteMin,$fechaVigenteMax)) ) }}
			</div>
			<div class="filtro__input">
				<button type="submit">Generar Gráfico</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
</div>
<div class="graphs">
	<div class="graph__box">
		<div class="graph__label">
			@if(is_null($vigencia))
			<h5>Número total de convenios vigentes por clasificación </h5>
			@else
			<h5>Número total de convenios vigentes por clasificación en el año {{$vigencia}} </h5>
			@endif
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph8">
			</canvas>
			<div class="button button--excel bg-info" id="exportar__grafico--8">
				<span  class="nav__link nav__link--small nav__link--white">
				<span class="link__icon--margin">
				<i class="fa-solid fa-file"></i>
				</span>
				Exportar Imágen
				</span>
			</div>
		</div>
	</div>
	<div class="graph__box">
		<div class="graph__label graph__label--year ">
			@if(is_null($vigencia))
			<h5>Nivel de Cumplimineto Parcial de los  convenios por clasificación</h5>
			@else
			<h5>Nivel de Cumplimineto Parcial de los  convenios por clasificación en el año {{$vigencia}} </h5>
			@endif
			<h5>
		</div>
		<div class="graph">
		<canvas class="canvas" id="graph9">
		</canvas>
		<div class="button button--excel" id="exportar__grafico--9">
		<span  class="nav__link nav__link--small nav__link--white">
		<span class="link__icon--margin">
		<i class="fa-solid fa-file"></i>
		</span>
		Exportar Imágen
		</span>
		</div>
		</div>
	</div>
	<div class="graph__box">
	<div class="graph__label graph__label--year ">
	@if(is_null($vigencia))
	<h5>Nivel de Cumplimineto Total  de los convenios por clasificación </h5>
	@else
	<h5>Nivel de Cumplimineto Total  de los convenios por clasificación en el año {{$vigencia}} </h5>
	@endif
	</h5>
	</div>
	<div class="graph">
	<canvas class="canvas" id="graph10">
	</canvas>
	<div class="button button--excel" id="exportar__grafico--10">
	<span  class="nav__link nav__link--small nav__link--white">
	<span class="link__icon--margin">
	<i class="fa-solid fa-file"></i>
	</span>
	Exportar Imágen
	</span>
	</div>
	</div>
	</div>
</div>