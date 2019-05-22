<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Document</title>
</head>
<style>
	body{
	   	size: 7in 9.25in;
	}
	table, th, td {
	  border: 1px solid black;
	}
	th, td {
	  padding: 5px;
	}
	table .centerTitle{
		width: 50%;
		text-align: center;
	}
	table .leftTitle{
		width: 25%;
	}
	table .leftTitle img{
		width: 130px;
		height: 50px;
	}
	table .rightTitle{
		width: 30%;
	}
	.page{
		background-color: #D9D9DB;
	}
	.bodyForm{
		width: 100%;
		text-align: center;
	}
	.titleSection{
		background-color: #BBBDC0;
	}
	td.labelSection {
	    font-size: 12px;
	    padding: 3px 0 !important;
	}
	td.infoText {
		height: 18px;
	    font-size: 15px;
	    padding: 3px 0 !important;
	}
</style>
<body>
	<div class="page">
		<table class="plantilla" style="width:100%">
			<tr>
				<td rowspan="4" class="leftTitle">
					<img class="logo" src="./storage/spsapplogo2.png" alt="Logo de Southern Procurement Services">
				</td>
				<td rowspan="4" class="centerTitle">
					<strong>Solicitud de Logistica de Viajes</strong>
				</td> 
				<td colspan="2" class="rightTitle">
					Codigo: SPS-FAD-007
				</td> 
			</tr>
			<tr>
				<td style="width:15%;">
					Edicion: 1
				</td> 
				<td style="width:15%;">
					Revision: 0
				</td> 
			</tr>
			<tr>
				<td colspan="2" style="width:30%;">
					Pag 1 de 2
				</td> 
			</tr>
			<tr>
				<td colspan="2" style="width:30%;">
					Fecha 17/10/2018
				</td> 
			</tr>
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td colspan="5" class="titleSection">
					<strong>Datos del Solicitante</strong>
				</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Nombre y apellido del solicitante</strong><br></td>
				<td class="labelSection"><strong>Cedula de identidad</strong></td>
				<td class="labelSection"><strong>Unidad</strong></td>
				<td class="labelSection"><strong>Sede</strong></td>
				<td class="labelSection"><strong>Fecha de solicitud</strong></td>
			</tr>
			<tr>
				<td class="infoText">{{ $reserva->user->name }} {{ $reserva->user->last_name }}<br></td>
				<td class="infoText">{{ $reserva->user->id }}</td>
				<td class="infoText">{{ $reserva->user->departamento->disp_name}}</td>
				<td class="infoText">{{ $reserva->user->sede}}</td>
				<td class="infoText">{{ $reserva->created_at }}</td>
			</tr>
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td colspan="2" class="titleSection">
					<strong>Nacional (Venezuela)</strong>
				</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Origen</strong><br></td>
				<td class="labelSection"><strong>Destino</strong></td>
			</tr>
			<tr>
				<td class="infoText">{{ $reserva->origen_a }}<br></td>
				<td class="infoText">{{ $reserva->destino_a }}</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Direccion (origen)</strong><br></td>
				<td class="labelSection"><strong>Direccion (destino)</strong></td>
			</tr>
			<tr>
				<td class="infoText">{{ $reserva->origen_det }}</td>
				<td class="infoText">{{ $reserva->destino_det }}</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Agenda</strong><br></td>
				<td class="labelSection"><strong>Motivo</strong></td>
			</tr>
			<tr>
				<td class="infoText">{{ $reserva->agenda }}<br></td>
				<td class="infoText">{{ $reserva->motivo }}</td>
			</tr>
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td colspan="5" class="titleSection">
					<strong>Traslados</strong>
				</td>
			</tr>
			@if(count($reserva->traslados)>0)
				<tr>
					<td class="labelSection"><strong>Fecha y hora</strong><br></td>
					<td class="labelSection"><strong>Origen y/o Direccion</strong></td>
					<td class="labelSection"><strong>Destino y/o Direccion</strong></td>
					<td class="labelSection"><strong>Descripcion</strong></td>
					<td class="labelSection"><strong>Tipo</strong></td>
				</tr>
				@foreach ($reserva->traslados as $traslado)
					<tr>
						<td class="infoText" style="width:10%;">{{$traslado->fecha_hora}}<br></td>
						<td class="infoText" style="width:25%;">{{$traslado->origen}}</td>
						<td class="infoText" style="width:25%;">{{$traslado->destino}}</td>
						<td class="infoText" style="width:20%;">{{$traslado->descripcion}}</td>
						<td class="infoText" style="width:10%;">{{$traslado->tipo}}</td>
					</tr>
				@endforeach
			@else
				<td colspan="5" class="infoText">
					Esta reserva no posee traslados asignados
				</td>
			@endif
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td colspan="3" class="titleSection">
					<strong>Hospedaje</strong>
				</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Fecha check-in</strong><br></td>
				<td class="labelSection"><strong>Fecha check-out</strong></td>
				<td class="labelSection"><strong>Lugar o ciudad</strong></td>
			</tr>
			@for ($i = 0; $i <= 2; $i++)
				<tr>
					<td class="infoText">01/01/2023<br></td>
					<td class="infoText">02/01/2023</td>
					<td class="infoText">Cabimas Hotel Europa</td>
				</tr>
			@endfor
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td class="titleSection">
					<strong>Observaciones</strong>
				</td>
			</tr>
			<tr>
				<td class="infoText">
					Praesent maximus arcu feugiat, finibus est vel, convallis mauris. Etiam sit amet lacinia ante, vehicula facilisis lacus. Vivamus dignissim luctus nisl eget imperdiet. Nunc non magna condimentum, pellentesque metus ut, aliquam lectus. Pellentesque ut pharetra dolor, id sagittis ipsum. Phasellus quis malesuada enim, id aliquam orci.
				</td>
			</tr>
		</table>
		<table class="bodyForm" style="width:100%">
			<tr>
				<td class="titleSection">
					<strong>Aprobado por</strong>
				</td>
				<td class="titleSection">
					<strong>Recibido por</strong>
				</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Nombre y apellido del supervisor inmediato</strong><br></td>
				<td class="labelSection"><strong>Nombre y apellido</strong></td>
			</tr>
			<tr>
				<td class="infoText">
				</td>
				<td class="infoText">
				</td>
			</tr>
			<tr>
				<td class="labelSection"><strong>Cargo</strong><br></td>
				<td class="labelSection"><strong>Firma</strong></td>
			</tr>
			<tr>
				<td class="infoText">
				</td>
				<td class="infoText">
				</td>
			</tr>
		</table>
	</div>
</body>
</html>