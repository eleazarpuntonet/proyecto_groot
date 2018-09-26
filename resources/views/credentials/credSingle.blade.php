@extends('layouts.mainLayout')
@section('contenido')

	<div class="container-fluid mainTitle">
		<div class="row">
			<div class="col"></div>
			<div class="col">
				<h1>{{ $credencial->descripcion }}</h1>
			</div>
			<div class="col"></div>
		</div>
	</div>


	<div id="formBox" class="container">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="id_site">Site</label>
		      <input readonly type="text" class="form-control" id="id_site" placeholder="id_site" name="id_site" value="{{ $credencial->id_site }}">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="descripcion">Descripcion</label>
		      <input readonly type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" value="{{ $credencial->descripcion }}">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="user">User</label>
		      <input readonly type="text" class="form-control" id="user" placeholder="Ip del Sitio" name="user" value="{{ $credencial->user }}">
		    </div>
		    <div class="form-group col-md-4">
		      <label for="passw">Passw</label>
				<input readonly type="text" class="form-control" id="passw" placeholder="passw" name="passw" value="{{ $credencial->passw }}">
		    </div>
	        <div class="form-group col-md-4">
	          <label for="comentarios">Comentarios</label>
	    		<input readonly type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" value="{{ $credencial->comentarios }}">
	        </div>
		  </div>
	</div>

@endsection
