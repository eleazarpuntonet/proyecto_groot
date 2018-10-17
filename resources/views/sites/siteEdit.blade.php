@extends('layouts.mainLayout')
@section('contenido')
	
	<sites-edit 	perfil_edit='{{ ($site)  }}' 
						info='{{session()->has('info')?'true':'false'}}'>
	</sites-edit>


@endsection