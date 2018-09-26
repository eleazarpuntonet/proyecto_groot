<?php

namespace App\Http\Controllers;

use App\Credenciales;
use Illuminate\Http\Request;

class credentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credenciales = Credenciales::all();
        return view('credentials.credList',compact('credenciales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('credentials.credAddNew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credencial              = new Credenciales;
        $credencial->id_site     = $request->input('id_site');
        $credencial->descripcion = $request->input('descripcion');
        $credencial->user        = $request->input('user');
        $credencial->passw       = $request->input('passw');
        $credencial->comentarios = $request->input('comentarios');
        $credencial->save();
        return redirect()->route('credenciales.create')->with('info','Registro completado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credenciales  $credenciales
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credencial = Credenciales::findOrFail($id);
        return  view('credentials.credSingle',compact('credencial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Credenciales  $credenciales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credencial = Credenciales::findOrFail($id);
        return  view('credentials.credEdit',compact('credencial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credenciales  $credenciales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $credencial              = Credenciales::findOrFail($id);
        $credencial->id_site     = $request->input('id_site');
        $credencial->descripcion = $request->input('descripcion');
        $credencial->user        = $request->input('user');
        $credencial->passw       = $request->input('passw');
        $credencial->comentarios = $request->input('comentarios');
        $credencial->save();
        return redirect()->route('credenciales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credenciales  $credenciales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Credenciales::findOrFail($id)->delete();  
        return redirect()->route('credenciales.index');
    }
}
