@extends('layouts.mainLayout')
@section('contenido')
<fact-list datasend='{{ json_encode($facturacion) }}'></fact-list>

{{-- <div class="container-fluid mainTitle">
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
	        <th scope="col">Proveedor</th>
	        <th scope="col">Servicio</th>
	        <th scope="col">Ciclo de Facturacion</th>
	        <th scope="col">Fecha de Corte</th>
	        <th scope="col">Importe</th>
	        <th scope="col">Editar</th>
	    </tr>
	  </thead>

	  <tbody>
	  	@foreach($facturacion as $factura)
		    <tr>
		      <td scope="row">
		      	<a href="{{ route('facturacion.show',$factura->id) }}">{{ $factura->id_proveedor }}</a>
		      </td>
		      <td>{{ $factura->servicio }}</td>
		      <td>{{ $factura->ciclo_facturacion }}</td>
		      <td>{{ $factura->fecha_corte }}</td>
		      <td>{{ $factura->importe }}</td>
		      <td>
				<div class="container" id="editButtons">
					<div class="button-btn">
						<button type="button" class="btn btn-light btn-sm">
							<a href="{{ route('facturacion.edit',$factura->id) }}">Editar</a>
						</button>
					</div>
					<div class="button-btn">
				      	<form action="{{  route('facturacion.destroy',$factura->id) }}" method="POST">
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
</div> --}}

@endsection