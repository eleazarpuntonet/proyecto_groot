@extends('layouts.mainLayout')
@section('contenido')
<fact-new></fact-new>

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
		<form action="{{ route('facturacion.store') }}" method="POST">
		  <div class="form-row">
		  	{{ csrf_field() }}
		    <div class="form-group col-md-6">
		      <label for="id_proveedor">Proveedor</label>
	      		<select name="id_proveedor" class="form-control hostingSelect">
	      		  <option> Seleccione un Hosting</option>
	      		</select>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="servicio">Servicio</label>
		      <input type="text" class="form-control" id="servicio" placeholder="Servicio" name="servicio" value="">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="ciclo_facturacion">Ciclo de Facturacion</label>
		      <select name="ciclo_facturacion" class="form-control">
		        <option value="Diario">Diario</option>
		        <option value="Anual">Anual</option>
		        <option value="Mensual">Mensual</option>
		        <option value="Semanal">Semanal</option>
		        <option value="Diario">Diario</option>
		        <option value="Unico">Unico</option>
		      </select>
		    </div>
		    <div class="form-group col-md-4">
		      <label for="fecha_corte">Fecha de Corte</label>
				<input type="date" class="form-control" id="fecha_corte" placeholder="fecha_corte" name="fecha_corte" value="">
		    </div>
	        <div class="form-group col-md-4">
	          <label for="importe">Importe</label>
	    		<input type="text" class="form-control" id="importe" placeholder="importe" name="importe" value="">
	        </div>
		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif --}}
@endsection