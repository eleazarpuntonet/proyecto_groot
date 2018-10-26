<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spahome');
    }

    public function homeCore()
    {
        return view('homecore');
    }

    public function ajaxtest($value='')
    {
        $infox = [
            'Nombre'=>'Eleazar Ortega',
            'Cargo'=>'Programador'
        ];
        return view('testing',compact('infox'));
    }
}
