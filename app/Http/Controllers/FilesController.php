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

use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

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
        $client        = new Client('XJciitEJCWAAAAAAAAActiFR1EoBjC2ndI7dzg1h60apN5EUUoMGq8Edjq-PDPch');
        $adapter       = new DropboxAdapter($client);
        $filesystem    = new Filesystem($adapter);

        if ($request->hasFile('file')) {
            $name           = $request['file']->getClientOriginalName();
            $guessExtension = $request->file('file')->guessExtension();
            $file           = $request->file('file')->storeAs('images', $name);
            $client->upload('/varios/'.$name,fopen($request->file('file')->getRealPath(),'rb'));

            return response()->json([
                'message' => $request,
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

        $pdf = PDF::loadView('Files.planillareserva',compact('reserva'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('archivo.pdf');

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

    public function csvfile(Request $request)
    {
        if ($request->hasFile('file')) {
            $name           = $request['file']->getClientOriginalName();
            $guessExtension = $request->file('file')->guessExtension();
            $file           = $request->file('file')->storeAs('images', $name);
            // dd(file_get_contents($request['file']));
            return response()->json([
                'message' => $request,
                'path' => $file,
                'ext' => $guessExtension,
                'status' => 200
            ], 200);
        } else {
            return 'no file';
        }
    }
}
