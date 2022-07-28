<div class="filtro">
	<div class="filtro__caducado">
		<h5>Seleccione el año para filtrar los convenios caducados</h5>
		</br>
		<form  method="POST" action="{{route('tecnico.reporte')}}">
			<div class="filtro__year">
				@csrf
				{{ Form::select('caducado', array('' => 'Todos') + array_combine(range($fechaCaducadoMin,$fechaCaducadoMax),range($fechaCaducadoMin,$fechaCaducadoMax)) ) }}
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
			@if(is_null($caducado))
			<h5>Número total de convenios caducados por clasificación</h5>
			@else
			<h5>Número total de convenios caducados por clasificación en el año {{$caducado}} </h5>
			@endif
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph11">
			</canvas>
			<div class="button button--excel bg-info" id="exportar__grafico--11">
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
			@if(is_null($caducado))
			<h5>Nivel de Cumplimineto Parcial de los  convenios caducados por clasificación</h5>
			@else
			<h5>Nivel de Cumplimineto Parcial de los  convenios caducados por clasificación en el año {{$caducado}} </h5>
			@endif
			</h5>
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph12">
			</canvas>
			<div class="button button--excel" id="exportar__grafico--12">
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
			@if(is_null($caducado))
			<h5>Nivel de Cumplimineto Total de los  convenios caducados por clasificación</h5>
			@else
			<h5>Nivel de Cumplimineto Total de los  convenios caducados por clasificación en el año {{$caducado}} </h5>
			@endif
		</div>
		<div class="graph">
			<canvas class="canvas" id="graph13">
			</canvas>
			<div class="button button--excel" id="exportar__grafico--13">
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