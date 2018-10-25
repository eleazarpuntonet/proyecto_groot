<?php

namespace App\Http\Controllers;

use App\Facturacion;
use Illuminate\Http\Request;

class factController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index()
    {
        $facturacion = Facturacion::all();
        // return view('fact.fctList',compact('facturacion'));
        return $facturacion;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fact.factAddNew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facturacion                    = new Facturacion;
        $facturacion->id_proveedor      = $request->input('id_proveedor');
        $facturacion->servicio          = $request->input('servicio');
        $facturacion->ciclo_facturacion = $request->input('ciclo_facturacion');
        $facturacion->fecha_corte       = $request->input('fecha_corte');
        $facturacion->importe           = $request->input('importe');
        $facturacion->save();

        return redirect()->route('facturacion.index')->with('info','Registro completado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facturacion = Facturacion::findOrFail($id);
        return  view('fact.factSingle',compact('facturacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facturacion = Facturacion::findOrFail($id);
        return  view('fact.factEdit',compact('facturacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $facturacion                    = Facturacion::findOrFail($id);
         $facturacion->servicio          = $request->input('servicio');
         $facturacion->ciclo_facturacion = $request->input('ciclo_facturacion');
         $facturacion->fecha_corte       = $request->input('fecha_corte');
         $facturacion->importe           = $request->input('importe');
         $facturacion->save();

        return redirect()->route('facturacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facturacion  $facturacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Facturacion::findOrFail($id)->delete();
        return redirect()->route('facturacion.index');
    }
}
