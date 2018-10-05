@extends('layouts.mainLayout')
@section('contenido')
	
	<sites-edit-form 	perfil_edit='{{ ($site)  }}' 
						info='{{session()->has('info')?'true':'false'}}'>
	</sites-edit-form>


@endsection