<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Proveedor;


class ItWebServicesController extends Controller
{

    function __construct(){
        // $this->middleware('auth:api', ['except'=>['index','show']]);
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::with('sites')->get();
        return response()->json($proveedores, 200 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ItWebservices.vistaProveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor              = new Proveedor;
        $proveedor->nombre      = $request->input('nombre');
        $proveedor->cuenta      = $request->input('cuenta');
        $proveedor->usuario     = $request->input('usuarioDeProveedor');
        $proveedor->password    = $request->input('passwdDeProveedor');
        $proveedor->comentarios = $request->input('comentarios');
        $proveedor->save();
        return redirect()->route('proveedores.create')->with('info','Registro completado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $proveedor = Proveedor::findOrFail($id)->with('sites')->get();
        return response()->json($proveedor, 200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id)->with('sites')->get();
        // return  view('ItWebservices.proveedoresEdit',compact('proveedor'));
        return response()->json($proveedor, 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor              = Proveedor::findOrFail($id);
        $proveedor->nombre      = $request->input('nombre');
        $proveedor->cuenta      = $request->input('cuenta');
        $proveedor->usuario     = $request->input('usuarioDeProveedor');
        $proveedor->password    = $request->input('passwdDeProveedor');
        $proveedor->comentarios = $request->input('comentarios');
        $proveedor->save();

        return redirect()->route('proveedores.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Proveedor::findOrFail($id)->delete();
        // return redirect()->route('proveedores.index'); 
        return "Sitio eliminado";
        //
    }
}
