<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style>
	body{
		width  : 216mm;
		height : 279mm;
		padding-left: 1.5cm;
		padding-top: 1.5cm;
	}
	.bloque{
		display : table;
		border  : 1px solid black;
		width   : 100%;

	}
	.planilla{
		display: flex;
		flex-direction: column;
		justify-content: initial;
		font-family: 'Lato', sans-serif;
	}
	.logo{
		margin: 15px;
		height: 60px;
	}
	.header{
		display: flex;
		flex-direction: row;
		justify-content: space-between;
	}
	.databloq{
		display: flex;
		flex-direction: column;
	}
	.databloq{
		font-size: 0.5rem;
	}
	.logocontainer{
		display: flex;
		flex-direction: columns;
		justify-content: center;
	}
	.header .bloque{
		height: 2.55cm;
	}
	.bloqrow{
		display: flex;
		border: 1px solid black;
		flex-direction: column;
		justify-content: center;
		height: 100%;
	}
	.header div {
	  display: flex;
	  flex-direction: column;
	  justify-content: center;
	}
	.campo{
		display: flex;
		flex-direction: column;
		justify-content: center;
		border: 1px solid black;
		height: .7cm;
		font-size: .65rem;
	}
	.campor{
		display: flex;
		flex-direction: row;
		justify-content: center;
		border: 1px solid black;
		height: 1.2cm;
		font-size: .9rem;
	}
	.formbloq{
		text-align: center;
		display: flex;
	}
	.titulo{
		width: 100%;
		background-color: #BBBDC0;
		border: 1px solid black;
		text-align: center;
		font-size: .75rem;
		height: .5cm;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	.checkox{
		width: 10px;
		height:10px;
		margin: 3px;
		border: 1px solid black;
		align-self: flex-end;
	}
	.check{
		display: flex;
		flex-direction: row;
		align-content: flex-start
	}
	.labelgrey{
		text-align: center;
	}
	.sign{
		border: 1px solid black;
		height: .7cm;
		font-size: .7rem;
		display: flex;
		flex-direction: row;
	}
</style>
<body>
	{{-- {{ $reserva }} --}}
	<div class="planilla">
		<div class="header">
			<div class="bloque logocontainer" style="width: 40%;">
				<img class="logo" src="/storage/spsapplogo2.png" alt="Logo de Southern Procurement Services">
			</div>
			<div class="bloque" style="text-align:center;font-size:1.3rem">
				<strong>Solicitud de Logistica de Viajes</strong>
			</div>
			<div class="databloq" style="width: 40%;">
				<div class="bloqrow">
					Codigo: SPS-FAD-007
				</div>
				<div style="display: flex; flex-direction: row; height: 100%;">
					<div class="bloqrow" style="height: auto;width: 100%;">
						Edicion: 1
					</div>
					<div class="bloqrow" style="height: auto;width: 100%;">
						Revision: 0
					</div>
				</div>
				<div class="bloqrow">
					Pag 1 de 2
				</div>
				<div class="bloqrow">
					Fecha 17/10/2018
				</div>
			</div>
		</div>

		<div class="titulo">
			Datos del Solicitante
		</div>

		<div class="formbloq">
			<div class="campo" style="width: 60%;">
				<div class="label">Nombre y Apellido del Solicitante</div>
				<div class="input"> <strong>{{ $reserva->user->name }} {{ $reserva->user->last_name }}</strong> </div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Cedula de Identidad</div>
				<div class="input"> <strong>{{ $reserva->user->id }}</strong> </div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Unidad o Area</div>
				<div class="input"> <strong>{{ $reserva->user->departamento->disp_name}}</strong> </div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Sede</div>
				<div class="input"> <strong>{{ $reserva->user->sede}}</strong> </div>
			</div>
			<div class="campo" style="width: 25%;">
				<div class="label">Fecha de Solicitud</div>
				<div class="input"> <strong>{{ $reserva->created_at }}</strong> </div>
			</div>
		</div>

		<div class="titulo">
			NACIONAL (VENEZUELA)
		</div>

		<div class="formbloq">
			<div class="campo" style="width: 50%; background-color: #BBBDC0;">
				<div class="labelgrey"> 
					Agenda
				</div>
			</div>
			<div class="campo" style="width: 50%; background-color: #BBBDC0;">
				<div class="labelgrey"> 
					Motivo del Viaje
				</div>
			</div>
		</div>

		<div class="formbloq">
			<div class="campo" style="width: 50%;">
				<div class="labelgrey"> 
					{{ $reserva->agenda }}
				</div>
			</div>
			<div class="campo" style="width: 50%;">
				<div class="labelgrey"> 
					{{ $reserva->motivo }}
				</div>
			</div>
		</div>

		<div class="titulo">
			Traslados
		</div>

		@if(count($reserva->traslados)>0)
			<div class="formbloq">
				<div class="campo" style="width: 10%;">
					<div class="label">Fecha y hora</div>
				</div> 
				<div class="campo" style="width: 35%;">
					<div class="label">Origen y/o Direccion</div>
				</div>
				<div class="campo" style="width: 35%;">
					<div class="label">Destino y/o Direccion</div>
				</div>
				<div class="campo" style="width: 20%;">
					<div class="label">Descripcion</div>
				</div>
				<div class="campo" style="width: 10%;">
					<div class="label">Tipo</div>
				</div>
			</div>
			@foreach ($reserva->traslados as $traslado)
			    <div class="formbloq">
			    	<div class="campo" style="width: 10%;">
			    		<div class="label"><strong>{{$traslado->fecha_hora}}
			    		</strong></div>
			    	</div>
			    	<div class="campo" style="width: 35%;">
			    		<div class="label"><strong>{{$traslado->origen}}</strong></div>
			    	</div>
			    	<div class="campo" style="width: 35%;">
			    		<div class="label"><strong>{{$traslado->destino}}</strong></div>
			    	</div>
			    	<div class="campo" style="width: 20%;">
			    		<div class="label"><strong>{{$traslado->descripcion}}</strong></div>
			    	</div>
			    	<div class="campo" style="width: 10%;">
			    		<div class="label"><strong>{{$traslado->tipo}}</strong></div>
			    	</div>
			    </div>
			@endforeach
		@else
		    <div class="formbloq">
		    	<div class="campo" style="width: 100%;">
		    		<div class="label"><strong>Esta reserva no posee traslados</strong></div>
		    	</div>
		    </div>
		@endif

		<div class="titulo">
			Hospedaje 
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Entrada: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Salida: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 40%;">
				<div class="label">Lugar o Ciudad: <strong>Cabimas Hotel Europa</strong></div>
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Entrada: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Salida: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 40%;">
				<div class="label">Lugar o Ciudad: <strong>Cabimas Hotel Europa</strong></div>
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Entrada: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 30%;">
				<div class="label">Fecha de Salida: <strong> 01/01/2023 </strong></div>
			</div>
			<div class="campo" style="width: 40%;">
				<div class="label">Lugar o Ciudad: <strong>Cabimas Hotel Europa</strong></div>
			</div>
		</div>
		<div class="titulo">
			Observaciones 
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 100%;">
				<div class="label"></div>
			</div>
		</div>

		<div style="display:flex">
			<div class="titulo" style="width:50%">
				Aprobado Por 
			</div>
			<div class="titulo" style="width:50%">
				Recibido Por 
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 50%;">
				<div class="label">Nombre y Apellido del Supervisor Inmeadiato </div>
			</div>
			<div class="campo" style="width: 50%;">
				<div class="label"> Nombre y Apellido </div>
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 50%;">
				<div class="label"></div>
			</div>
			<div class="campo" style="width: 50%;">
				<div class="label"></div>
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 50%;">
				<div class="label">Cargo</div>
			</div>
			<div class="campo" style="width: 50%;">
				<div class="label">Firma</div>
			</div>
		</div>
		<div class="formbloq">
			<div class="campo" style="width: 50%;">
				<div class="label"></div>
			</div>
			<div class="campo" style="width: 50%;">
				<div class="label"></div>
			</div>
		</div>

	</div>
</body>
</html>