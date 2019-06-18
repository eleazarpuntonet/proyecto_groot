<?php

namespace App\Http\Controllers;
use App\Proyectos;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$objeto = json_decode($request->proyecto);

    	// $proy                   = new Proyectos;
    	// $proy->nombre           = $request->input('n_proyecto');
    	// $proy->status           = $request->input('status');
    	// $proy->presupuesto_bsf  = $request->input('presupuesto_absf');
    	// $proy->presupuesto_usd  = $request->input('presupuesto_busd');
    	// $proy->precio_venta_sb  = $request->input('precio_venta');
    	// $proy->precio_venta_usd = $request->input('precio_ventaUSD');
    	// $proy->factibilidad     = $request->input('factibilidad');
    	// $proy->descripcion      = $request->input('descripcion');

    	// $proy->participantes    = $request->input('participantes');
    	// $proy->responsable      = $request->input('responsable');
    	// $proy->contacto         = $request->input('contacto');
    	// $proy->empresa          = $request->input('empresa');
    	
    	// $proy->zona             = $request->input('zona');
    	// $proy->accion           = $request->input('accion');
    	// $proy->fecha_accion     = $request->input('fecha_accion');
    	// $proy->save();
        return $request->proyecto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
