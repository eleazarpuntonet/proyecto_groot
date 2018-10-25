<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Sites;

class sitesController extends Controller
{
    function __construct(){
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Sites::all();
        // return view('sites.siteList',compact('sites'));
        return $sites;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('sites.newSiteForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sites          = new Sites;
        $sites->dominio = $request->input('dominio');
        $sites->hosting = $request->input('hosting');
        $sites->ip_site = $request->input('ip_site');
        $sites->status  = $request->input('status');
        $sites->save();
        return redirect()->route('sites.create')->with('info','Registro completado!');
        // dd($request->request);
        // return 'Recibiendo desde servidor';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Sites::findOrFail($id);
        return  view('sites.siteSingle',compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Sites::findOrFail($id);
        // return  "Textpo";
        return  view('sites.siteEdit',compact('site'));
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
        $sites          = Sites::findOrFail($id);
        $sites->dominio = $request->input('dominio');
        $sites->hosting = $request->input('hosting');
        $sites->ip_site = $request->input('ip_site');
        $sites->status  = $request->input('status');
        $sites->save();
        return redirect()->route('sites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sites::findOrFail($id)->delete();
        // return "Destruye ".$id; 
        return redirect()->route('sites.index'); 
    }
}
