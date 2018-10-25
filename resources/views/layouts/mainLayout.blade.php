<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">
		<title>Proyecto Groot</title>
		<link rel="stylesheet" href="/css/app.css">
	</head>

	<body>
		@routes
	<div id="app">
		

		@php
			function activeMenu($url){
				return request()->is($url)?'active':'';
			}
		@endphp
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="#">IT</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExample07">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('home') }}">Home<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdProveedores" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proveedores</a>

							<div class="dropdown-menu" aria-labelledby="dropdProveedores">
								<a class="dropdown-item" href="{{ route('proveedores.index') }}">Lista de 
								proveedores</a>
								@if(auth()->check())
									<a class="dropdown-item" href="{{ route('proveedores.create') }}">Agregar Nuevo</a>
								@endif
								
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdSites" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sitios</a>

							<div class="dropdown-menu" aria-labelledby="dropdSites">
								<a class="dropdown-item" href="{{ route('sites.index') }}">Lista de 
								Sitios</a>
								@if(auth()->check())
									<a class="dropdown-item" href="{{ route('sites.create') }}">Agregar Nuevo</a>
								@endif
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdSites" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Credenciales</a>

							<div class="dropdown-menu" aria-labelledby="dropdSites">
								<a class="dropdown-item" href="{{ route('credenciales.index') }}">Lista de 
								Credenciales</a>
								@if(auth()->check())
									<a class="dropdown-item" href="{{ route('credenciales.create') }}">Agregar Nuevo</a>

								@endif

							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdSites" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Datos de Facturacion</a>

							<div class="dropdown-menu" aria-labelledby="dropdSites">
								<a class="dropdown-item" href="{{ route('facturacion.index') }}">Lista de 
								datos de Facturacion</a>
								@if(auth()->check())
									<a class="dropdown-item" href="{{ route('facturacion.create') }}">Agregar Nuevo</a>

								@endif
								
							</div>
						</li>
        @guest
							
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">Login<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">Registrar<span class="sr-only">(current)</span></a>
						</li>
        @else
    				@if(auth()->user()->hasRoles(['admin','suscriptor']))
    					<li class="nav-item">
    						<a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
    					</li>
    				@endif
					</ul>
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							    @csrf
							</form>
							<a class="dropdown-item" href="{{ route('logout') }}"
							   onclick="event.preventDefault();
							                 document.getElementById('logout-form').submit();">
							    {{ __('Logout') }}
							</a>
						</div>
					</div>
        @endguest
				</div>
			</div>
		</nav>

@yield('contenido')
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="/js/jquery3.js"></script>
		<script src="/js/app.js"></script>
		<script src="/js/main.js"></script>
		<footer>Copyright ® {{ date('Y') }}</footer>
	</body>
</html>