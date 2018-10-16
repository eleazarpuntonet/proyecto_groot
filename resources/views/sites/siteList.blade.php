@extends('layouts.mainLayout')
@section('contenido')
<sites-table datasend='{{ json_encode($sites)  }}' ></sites-table>
@endsection