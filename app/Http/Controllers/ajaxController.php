<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Sites;

class ajaxController extends Controller
{
	public function hosts(Request $request){
		$msg = "This is a simple message.";

		$proveedores = Proveedor::all();
		// return response()->json(array('msg'=> $msg), 200);
		return response()->json($proveedores, 200);

	}

	public function sites(Request $request){
		$sites = Sites::all();
		// return response()->json(array('msg'=> $msg), 200);
		return response()->json($sites, 200);
	}
    //
}
