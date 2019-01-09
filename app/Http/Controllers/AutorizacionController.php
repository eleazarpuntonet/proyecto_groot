<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservas;
use App\Autorizaciones;

class AutorizacionController extends Controller
{
    function __construct(){
        $this->middleware('auth:api');
    }
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

        // $reserva = Reservas::find(14);
        // $autorizacion            = new Autorizaciones;
        // $autorizacion->recurso   = 'Viatico';
        // $autorizacion->valor     = 'Aprobado';
        // $autorizacion->date_auth = date('Y-m-d H:i:s');
        // $reserva->autorizaciones()->save($autorizacion);

        // return response()->json([
        //     'reserva' => $reserva,
        //     'autoreserva' => true,
        //     'autoviatico' => true,
        // ]);

        return 'Bon voyage';
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
        $autorizacion            = Autorizaciones::find($id);
        if ($request->input('value')) {
            $autorizacion->valor     = 'Aprobado';
        } else {
            $autorizacion->valor     = 'Rechazado';
        }
        $autorizacion->date_auth = date('Y-m-d H:i:s');
        $autorizacion->save();

        return $autorizacion;
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
