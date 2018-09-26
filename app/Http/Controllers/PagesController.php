<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddProveedor;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function __construct($value='')
	{
		$this->middleware('xample');
		// $this->middleware('xample',['only'=>['home','contactos']]); SOLO ESTOS METODOS
		// $this->middleware('xample',['except'=>['home','contactos']]); EXCEPTO ESTOS METODOS
	}
    public function ajaxtest($value='')
    {
    	return 'Probando vista de pruebas ajax';
    }
}
