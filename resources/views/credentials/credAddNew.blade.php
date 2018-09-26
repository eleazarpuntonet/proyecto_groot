@extends('layouts.mainLayout')
@section('contenido')

	<div class="container-fluid mainTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h1>Registro de Credenciales</h1>
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
		<form action="{{ route('credenciales.store') }}" method="POST">
		  	{{ csrf_field() }}
	  		  <div class="form-row">
	  		    <div class="form-group col-md-6">
	  		      <label for="id_site">Site</label>
	  		      <select name="id_site" class="form-control sitesSelect">
	  		        <option>Seleccione un Site</option>
	  		      </select>
	  		    </div>
	  		    <div class="form-group col-md-6">
	  		      <label for="descripcion">Descripcion</label>
	  		      <input type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" value="{{ old('descripcion') }}">
	  		    </div>
	  		  </div>
	  		  <div class="form-row">
	  		    <div class="form-group col-md-4">
	  		      <label for="user">Usuario</label>
	  		      <input type="text" class="form-control" id="user" placeholder="Usuario" name="user" value="{{ old('user') }}">
	  		    </div>
	  		    <div class="form-group col-md-4">
	  		      <label for="passw">Contraseña</label>
	  				<input type="text" class="form-control" id="passw" placeholder="Contraseña" name="passw" value="{{ old('passw') }}">
	  		    </div>
	  	        <div class="form-group col-md-4">
	  	          <label for="comentarios">Comentarios</label>
	  	    		<input type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" value="{{ old('passw') }}">
	  	        </div>
	  		  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif
@endsection