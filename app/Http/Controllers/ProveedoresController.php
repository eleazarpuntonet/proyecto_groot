<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Proveedores_;
use App\Contactos;
use App\Databasket;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proveedores_::get();
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
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $proveedor                  = new Proveedores_;
        $proveedor->dir             = $request->dir;
        $proveedor->nombre          = $request->nombre;
        $proveedor->pais            = $request->pais;
        $proveedor->r_social        = $request->r_social;
        $proveedor->rif             = $request->rif;
        $proveedor->t_contribuyente = $request->t_contribuyente;
        $proveedor->session         = $user->id;
        $proveedor->save();
        $extras   = json_decode($request->extras);
        $contacto = json_decode($request->contacto);

        if ( is_array($extras) ){
             foreach ($extras as $val) {
                $extra  = new Databasket;
                $extra->data = $val->data;
                $extra->key  = $val->key;
                $proveedor->extras()->save($extra);
             }
         } 

         if ( is_array($contacto) ){
              foreach ($contacto as $val) {
                 $contact              = new Contactos;
                 $contact->nombre      = $val->nombre;
                 $contact->value       = $val->value;
                 $contact->medio       = $val->medio;
                 $contact->descripcion = $val->descripcion;
                 $proveedor->contacto()->save($contact);
              }
          }

        return $proveedor;

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
