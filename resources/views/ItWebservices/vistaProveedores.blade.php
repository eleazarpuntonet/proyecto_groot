@extends('layouts.mainLayout')
@section('contenido')

	<div class="container-fluid mainTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h1>Registro de Nuevo Proveedor</h1>
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
		<form action="{{  route('proveedores.store') }}" method="POST">
		  <div class="form-row">
		  	{{ csrf_field() }}
		    <div class="form-group col-md-6">
		      <label for="nombre">Nombre</label>
		      <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="cuenta">Cuenta</label>
		      <input type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" value="{{ old('cuenta') }}">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="usuario">Usuario</label>
		      <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" value="{{ old('usuarioDeProveedor') }}">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="contrasena">Contraseña</label>
				<input type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor" value="{{ old('passwdDeProveedor') }}">
		    </div>
		  </div>
		  <div class="form-group">
		  	<label for="comentarios">Comentarios</label>
		  	<textarea class="form-control" id="comentarios" rows="3" name="comentarios" >
				{{ old('comentarios') }}
		  	</textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif

@stop