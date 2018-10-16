@extends('layouts.mainLayout')
@section('contenido')
<fact-edit 	perfil_edit='{{ ($facturacion)  }}' 
			info='{{session()->has('info')?'true':'false'}}'></fact-edit>
			
{{-- 	<div class="container-fluid mainTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h1>Registro de Datos de Proveedor</h1>
			</div>
			<div class="col"></div>
		</div>
	</div>

@if( session()->has('info') )
	<div class="container infoTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h3>{{ session('info') }}</h3>
			</div>
			<div class="col"></div>
		</div>
	</div>
@else

	<div id="formBox" class="container">
		<form action="{{ route('facturacion.update', $facturacion->id) }}" method="POST">
		  	{{ csrf_field() }}
		  	{{ method_field('PATCH') }}
		  <div class="form-row">
		    <div class="form-group col-md-12">
		      <label for="servicio">Servicio</label>
		      <input type="text" class="form-control" id="servicio" placeholder="Servicio" name="servicio" value="{{ $facturacion->servicio }}">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="ciclo_facturacion">Ciclo de Facturacion</label>
		      <input type="text" class="form-control" id="ciclo_facturacion" placeholder="Ip del Sitio" name="ciclo_facturacion" value="{{ $facturacion->ciclo_facturacion }}">
		    </div>
		    <div class="form-group col-md-4">
		      <label for="fecha_corte">Fecha de Corte</label>
				<input type="text" class="form-control" id="fecha_corte" placeholder="fecha_corte" name="fecha_corte" value="{{ $facturacion->fecha_corte }}">
		    </div>
		    <div class="form-group col-md-4">
		      <label for="importe">Importe</label>
				<input type="text" class="form-control" id="importe" placeholder="importe" name="importe" value="{{ $facturacion->importe }}">
		    </div>
		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif --}}
@endsection