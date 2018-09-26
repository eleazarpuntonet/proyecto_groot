@extends('layouts.mainLayout')

@section('contenido')
<div class="mainTitle">
	<h1>Ajax Testing</h1>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm testingDiv">
		<h1>Returning to test conection</h1>
    <button id="botonAjax">Click on me!</button>
    </div>
    <div class="col-sm">
      @if (session()->has('infox')))
      		{{session('infox')}}
      @endif
    </div>
  </div>
</div>


@endsection
