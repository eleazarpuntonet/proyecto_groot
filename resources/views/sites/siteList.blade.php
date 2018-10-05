@extends('layouts.mainLayout')
@section('contenido')
<sites-table datasend='{{ json_encode($sites)  }}' 
				url_={{ route('sites.show',0) }}></sites-table>
@endsection