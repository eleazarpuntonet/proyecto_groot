@extends('layouts.mainLayout')
@section('contenido')
<cred-edit 	perfil_edit='{{ ($credencial)  }}' 
			info='{{session()->has('info')?'true':'false'}}'></cred-edit>
			
{{-- 	<div class="container-fluid mainTitle">
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
		<form action="{{ route('credenciales.update',$credencial->id) }}" method="POST">
		  	{{ csrf_field() }}
			{{ method_field('PATCH') }}
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="id_site">Site</label>
			      <input type="text" class="form-control" id="id_site" placeholder="id_site" name="id_site" value="{{ $credencial->id_site }}">
			    </div>
			    <div class="form-group col-md-6">
			      <label for="descripcion">Descripcion</label>
			      <input type="text" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" value="{{ $credencial->descripcion }}">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-4">
			      <label for="user">User</label>
			      <input type="text" class="form-control" id="user" placeholder="Ip del Sitio" name="user" value="{{ $credencial->user }}">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="passw">Passw</label>
					<input type="text" class="form-control" id="passw" placeholder="passw" name="passw" value="{{ $credencial->passw }}">
			    </div>
		        <div class="form-group col-md-4">
		          <label for="comentarios">Comentarios</label>
		    		<input type="text" class="form-control" id="comentarios" placeholder="comentarios" name="comentarios" value="{{ $credencial->comentarios }}">
		        </div>
			  </div>
		  <button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	</div>

@endif --}}
@endsection