@extends('layouts.mainLayout')
@section('contenido')
	<site-new-form info='{{session()->has('info')?'true':'false'}}'
		></site-new-form>
@endsection