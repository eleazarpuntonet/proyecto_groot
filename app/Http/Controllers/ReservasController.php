<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservas;

class ReservasController extends Controller
{
    function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page='')
    {

        $reservas = Reservas::with('traslados')->with('autorizaciones')->paginate();
        return response()->json([
            'reservas' => $reservas,
        ]);
        // return response()->json([
        //     'reservas' => $page,
        // ]);
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
        $reserva                = new Reservas;
        $reserva->alcance       = $request->input('t_reserva');
        $reserva->origen_a      = $request->input('from_a');
        $reserva->origen_b      = $request->input('from_b');
        $reserva->origen_det    = $request->input('adress_a');
        $reserva->fecha_partida = $request->input('date_a');
        $reserva->fecha_retorno = $request->input('date_b');
        $reserva->destino_a     = $request->input('to_a');
        $reserva->destino_b     = $request->input('to_b');
        $reserva->destino_det   = $request->input('adress_b');
        $reserva->motivo        = $request->input('motivo');
        $reserva->agenda        = $request->input('agenda');
        // $reserva->save();

        return $request->input('t_reserva');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $reserva = Reservas::with([
            'traslados',
            'autorizaciones.gerencia',
            // 'autorizaciones.reservas',
            'user',
            'gerencia'])
                        ->findOrFail($id);
        return response()->json([
            'reserva' => $reserva,
        ]);
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
