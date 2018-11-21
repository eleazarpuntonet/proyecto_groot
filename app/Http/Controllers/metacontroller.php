<?php

namespace App\Http\Controllers;
use App\Countries;
use App\Cities;
use App\Estadosve;
use App\Ciudadesve;

use Illuminate\Http\Request;

class metacontroller extends Controller
{
    function __construct(){
        // $this->middleware('auth:api');
    }

    public function countrieslist()
    {
    	$countries = Countries::orderBy('country_name', 'asc')->get([
    		'country_name as text',
    		'country_iso_code as value',
    		'continent_name','geoname_id'
    	]);

    	return response()->json($countries);
    }

    public function citieslist($city)
    {	
    	$cities = Cities::where('country_iso_code',$city)->orderBy('city_name', 'asc')->get([
    		'city_name as text',
    		'geoname_id as value',
    	]);
    	return response()->json($cities);
    }

    public function ve_estados(){

    	$ve_estados = Estadosve::all();

    	return response()->json($ve_estados);
    }

    public function ve_ciudades($idEstado){

    	//Donde el ID del estado sea igual a $idEstado
    	$ve_ciudad = Ciudadesve::where('id_estado',$idEstado)->with('estados')->get();

    	return response()->json($ve_ciudad);
    }
}
