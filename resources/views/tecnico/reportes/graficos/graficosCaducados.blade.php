<div class="filtro">
	<div class="filtro__caducado">
		<h5>Seleccione el año para filtrar los convenios caducados</h5>
		</br>
		<form  method="POST" action="{{route('tecnico.reporte')}}">
			<div class="filtro__year">
				@csrf
				{{ Form::select('caducados', array('' => 'Todos') + array_combine(range($fechaCaducadoMin,$fechaCaducadoMax),range($fechaCaducadoMin,$fechaCaducadoMax)) ) }}
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
			@if(is_null($caducados))
			<h5>Número total de convenios caducados por clasificación</h5>
			@else
			<h5>Número total de convenios caducados por clasificación en el año {{$caducados}} </h5>
			@endif
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph4">
			</canvas>
			<div class="button button--excel bg-info" id="exportar__grafico--4">
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
			@if(is_null($caducados))
			<h5>Nivel de Cumplimineto Parcial de los  convenios caducados por clasificación</h5>
			@else
			<h5>Nivel de Cumplimineto Parcial de los  convenios caducados por clasificación en el año {{$caducados}} </h5>
			@endif
			</h5>
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph5">
			</canvas>
			<div class="button button--excel" id="exportar__grafico--5">
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
			@if(is_null($caducados))
			<h5>Nivel de Cumplimineto Total de los  convenios caducados por clasificación</h5>
			@else
			<h5>Nivel de Cumplimineto Total de los  convenios caducados por clasificación en el año {{$caducados}} </h5>
			@endif
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph7">
			</canvas>
			<div class="button button--excel" id="exportar__grafico--6">
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