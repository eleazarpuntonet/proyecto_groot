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
	        <th scope="col">Dominio</th>
	        <th scope="col">Hosting</th>
	        <th scope="col">Ip Site</th>
	        <th scope="col">Status</th>
	        <th scope="col">Editar</th>
	    </tr>
	  </thead>

	  <tbody>
	  	@foreach($sites as $site)
		    <tr>
		      <td scope="row">
		      	<a href="{{ route('sites.show',$site->id) }}">{{ $site->dominio }}</a>
		      </td>
		      <td>{{ $site->hosting }}</td>
		      <td>{{ $site->ip_site }}</td>
		      <td>{{ $site->status }}</td>
		      <td>
				<div class="container" id="editButtons">
					<div class="button-btn">
						<button type="button" class="btn btn-light btn-sm">
							<a href="{{ route('sites.edit',$site->id) }}">Editar</a>
						</button>
					</div>
					<div class="button-btn">
				      	<form action="{{  route('sites.destroy',$site->id) }}" method="POST">
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