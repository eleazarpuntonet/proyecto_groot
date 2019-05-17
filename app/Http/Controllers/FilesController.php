<?php

namespace App\Http\Controllers;

use App\Files;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use App\Reservas;
use App\Viaticos;
use App\Autorizaciones;
use App\User;
Use App\Providers\NuevaReserva;
use App\Notifications\Notificaciontest;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('Files.planillareserva'); 
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
        if ($request->hasFile('file')) {
            $md5Name = md5_file($request->file('file')->getRealPath());
            $guessExtension = $request->file('file')->guessExtension();
            $file = $request->file('file')->storeAs('images', $md5Name.'.'.$guessExtension);

            // $path = $request->file('file')->store('images');
            return response()->json([
                'message' => 'Upload success.',
                'path' => $file,
                'ext' => $guessExtension,
                'status' => 200
            ], 200);
        } else {
            return 'no file';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    // public function show(Files $files)
    public function show($id_file)
    {

        $reserva = Reservas::with([
            'viaticos',
            'viaticos',
            'traslados',
            'autorizaciones',
            'user.departamento',
            ])->findOrFail($id_file);

        return view('Files.planillareserva')
        ->with(compact('reserva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function edit(Files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files)
    {
        //
    }
}
