@extends('layouts.mainLayout')
@section('contenido')

<div class="container-fluid mainTitle">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<h1>Sitios</h1>
		</div>
		<div class="col"></div>
	</div>
</div>
<div class="container" id="mainTableProveedores">
	<table id="tableProv" class="table">
	  <thead class="thead-light">
	    <tr>
	        <th scope="col">Site</th>
	        <th scope="col">Descripcion</th>
	        <th scope="col">Usuario</th>
	        <th scope="col">Password</th>
	        <th scope="col">Comentarios</th>
	        <th scope="col">Editar</th>
	    </tr>
	  </thead>

	  <tbody>
	  	@foreach($credenciales as $credencial)
		    <tr>
		      <td scope="row">
		      	<a href="{{ route('credenciales.show',$credencial->id) }}">{{ $credencial->id_site }}</a>
		      </td>
		      <td>{{ $credencial->descripcion }}</td>
		      <td>{{ $credencial->user }}</td>
		      <td>{{ $credencial->passw }}</td>
		      <td>{{ $credencial->comentarios }}</td>
		      <td>
				<div class="container" id="editButtons">
					<div class="button-btn">
						<button type="button" class="btn btn-light btn-sm">
							<a href="{{ route('credenciales.edit',$credencial->id) }}">Editar</a>
						</button>
					</div>
					<div class="button-btn">
				      	<form action="{{  route('credenciales.destroy',$credencial->id) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-light btn-sm">Eliminar
							</button>
				      	</form>
					</div>
				</div>
		      </td>
		    </tr>
	  	@endforeach
	  </tbody>
	</table>
</div>

@endsection