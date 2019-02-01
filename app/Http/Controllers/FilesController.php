<?php

namespace App\Http\Controllers;

use App\Files;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Dompdf\Dompdf;


class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header('Content-type: application/pdf');
        http_response_code(200);
        include 'l_vars/planilla_solicitud_logistica.php';
        $html = '<strong>Solicitud de Logistica de Viajes</strong>';
        $pdf = new TCPDF();
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($planilla);
        
        $pdf::Output(public_path('_SamplePDF.pdf'), 'I');
        // $pdf::Output(public_path('_SamplePDF.pdf'), 'F');

        $file = public_path() . '/_SamplePDF.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
        ];



        return response()->stream($file, 'test.pdf', $headers);



       // instantiate and use the dompdf class

       // $dompdf = new Dompdf();
       // $dompdf->set_option('isHtml5ParserEnabled', true);
       // $dompdf->loadHtml($planilla);

       // // (Optional) Setup the paper size and orientation
       // // $dompdf->setPaper('A4', 'landscape');

       // // Render the HTML as PDF
       // $dompdf->render();

       // // Output the generated PDF to Browser
       // $dompdf->stream();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(Files $files)
    {
        //
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
