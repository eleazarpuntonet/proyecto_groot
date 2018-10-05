@extends('layouts.mainLayout')
@section('contenido')

{{-- <fact-list datasend='{{ json_encode($proveedor)  }}'></fact-list> --}}

<div class="container-fluid mainTitle">
	<div class="row">
		<div class="col"></div>
		<div class="col">
			<h1>Proveedores de Servicios</h1>
		</div>
		<div class="col"></div>
	</div>
</div>
<div class="container" id="mainTableProveedores">
	<table id="tableProv" class="table">
	  <thead class="thead-light">
	    <tr>
	        <th scope="col">Nombre</th>
	        <th scope="col">Cuenta</th>
	        <th scope="col">Usuario</th>
	        <th scope="col">Password</th>
	        <th scope="col">Comentarios</th>
	        <th scope="col">Editar</th>
	    </tr>
	  </thead>

	  <tbody>
	  	@foreach($proveedores as $proveedor)
		    <tr>
		      <td scope="row">
		      	<a href="{{ route('proveedores.show',$proveedor->id) }}">{{ $proveedor->nombre }}</a>
		      </td>
		      <td>{{ $proveedor->cuenta }}</td>
		      <td>{{ $proveedor->usuario }}</td>
		      <td>{{ $proveedor->password }}</td>
		      <td>{{ $proveedor->comentarios }}</td>
		      <td>
				<div class="container" id="editButtons">
					<div class="button-btn">
						<button type="button" class="btn btn-light btn-sm">
							<a href="{{ route('proveedores.edit',$proveedor->id) }}">Editar</a>
						</button>
					</div>
					<div class="button-btn">
				      	<form action="{{  route('proveedores.destroy',$proveedor->id) }}" method="POST">
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

@stop