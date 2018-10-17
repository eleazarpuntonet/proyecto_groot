@extends('layouts.mainLayout')
@section('contenido')
	<site-new info='{{session()->has('info')?'true':'false'}}'>
	</site-new>
@endsection