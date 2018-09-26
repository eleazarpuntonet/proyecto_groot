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
      <h3>Get Request</h3>
      <button id="buttonRequest" type="button" class="btn btn-dark">Dark</button>
    </div>
    <div class="col-sm">
      @if (session()->has('infox')))
      		{{session('infox')}}
      @endif
    </div>
  </div>
</div>


@endsection
