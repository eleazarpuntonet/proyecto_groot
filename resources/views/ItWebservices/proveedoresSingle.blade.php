@extends('layouts.mainLayout')
@section('contenido')
	<prov-show perfil_show="{{ $proveedor }}"></prov-show>

{{-- <div id="mainTitle" class="container-fluid">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<h1>{{ $proveedor->nombre }}</h1>
		</div>
		<div class="col"></div>
	</div>
</div>

<div id="formBox" class="container">
	  <div class="form-row">
	  	{{ csrf_field() }}
	    <div class="form-group col-md-6">
	      <label for="nombre">Nombre</label>
	      <input readonly type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ $proveedor->nombre }}">
	    </div>
	    <div class="form-group col-md-6">
	      <label for="cuenta">Cuenta</label>
	      <input readonly type="text" class="form-control" id="cuenta" placeholder="Cuenta" name="cuenta" value="{{ $proveedor->cuenta }}">
	    </div>
	  </div>
	  <div class="form-row">
	    <div class="form-group col-md-6">
	      <label for="usuario">Usuario</label>
	      <input readonly type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuarioDeProveedor" value="{{ $proveedor->usuario }}">
	    </div>
	    <div class="form-group col-md-6">
	      <label for="contrasena">Contraseña</label>
			<input readonly type="text" class="form-control" id="contrasena" placeholder="Contraseña" name="passwdDeProveedor" value="{{ $proveedor->password }}">
	    </div>
	  </div>
	  <div class="form-group">
	  	<label for="comentarios">Comentarios</label>
	  	<textarea class="form-control" id="comentarios" rows="3" name="comentarios" >
			{{ $proveedor->comentarios }}
	  	</textarea>
	  </div>
</div> --}}

@stop