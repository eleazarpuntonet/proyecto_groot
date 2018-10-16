@extends('layouts.mainLayout')
@section('contenido')
<prov-edit 	perfil_edit='{{ ($proveedor)  }}' 
					info='{{session()->has('info')?'true':'false'}}'>
</prov-edit>

{{-- 
<div  class="mainTitle container-fluid">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<h1>{{ $proveedor->nombre }}</h1>
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

<div id="registerFormBox" class="container">
	<form action="{{  route('proveedores.update',$proveedor->id) }}" method="POST">
	  <div class="form-row">
	  	{{ csrf_field() }}
		{{ method_field('PATCH') }}
	    <div class="form-group col-md-6">
	      <label for="nombre">Nombre</label>
	      <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ $proveedor->nombre }}">
	    </div>
	    <div class="form-group col-md-6">
	      <label for="cuenta">Cuenta</label>
	      <input type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" value="{{ $proveedor->cuenta }}">
	    </div>
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label for="usuario">Usuario</label>
	      <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" value="{{ $proveedor->usuario }}">
	    </div>
	    <div class="form-group col-md-6">
	      <label for="contrasena">Contraseña</label>
			<input type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor" value="{{ $proveedor->password }}">
	    </div>
	  </div>
	  <div class="form-group">
	  	<label for="comentarios">Comentarios</label>
	  	<textarea class="form-control" id="comentarios" rows="3" name="comentarios" >
			{{ $proveedor->comentarios }}
	  	</textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
</div>
@endif --}}

@stop