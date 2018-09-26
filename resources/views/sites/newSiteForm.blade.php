@extends('layouts.mainLayout')
@section('contenido')

	<div class="container-fluid mainTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h1>Registro de Sitio</h1>
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
		<form action="{{ route('sites.store') }}" method="POST">
		  <div class="form-row">
		  	{{ csrf_field() }}
		    <div class="form-group col-md-6">
		      <label for="dominio">Dominio</label>
		      <input type="text" class="form-control" id="dominio" placeholder="Dominio" name="dominio" value="{{ old('dominio') }}">
		    </div>
		    <div class="form-group col-md-6">
		      	<label for="hosting">Hosting</label>
				<select name="hosting" class="form-control hostingSelect">
				  <option>Seleccione un Hosting</option>
				</select>
				
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="ip_site">Ip del sitio</label>
		      <input type="text" class="form-control" id="ip_site" placeholder="Ip del Sitio" name="ip_site" value="{{ old('ip_site') }}">
		    </div>
		    <div class="form-group col-md-6">
		      	<label for="status">Status</label>
				<select name="status" class="form-control">
				  <option>ACTIVO</option>
				  <option>INACTIVO</option>
				</select>
		    </div>
		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif
@endsection