<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\ActionsAuth;
use App\Permisos;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return $roles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ActionsAuth::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role               = new Role;
        $role->name         = $request->name;
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        $role->save();

        $pack_paths = json_decode($request->input('pack_idPaths'));
        if (!empty($pack_paths)) {
            foreach ($pack_paths as $val) {
                $role->auth_roles()->attach($val);
            }
        }
        
        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    public function path_auth($id)
    {
        $Rol = Role::with(['auth_roles.actions'])->find($id);
        return $Rol;
    }
    
    public function permisos($data)
    {
        $objeto = json_decode($data);
        return Permisos::with('actions')
            ->whereIn('ruta_id', $objeto->findRutas)
            ->where('role_id', '=', $objeto->role->id)
            ->get();

    }

    public function accesos($data)
    {
        $objeto = json_decode($data);
        return User::with('permisos')->find($objeto->user_id)->permisos;
    }

    public function savepath($data)
    {
        $objeto = json_decode($data);
        $role = Role::find($objeto->role);
        if (!empty($objeto->added)) {
            foreach ($objeto->added as $val) {
                $role->auth_roles()->attach($val->ruta_id);
            }
        }
        if (!empty($objeto->deleted)) {
            foreach ($objeto->deleted as $val) {
                $role->auth_roles()->detach($val->ruta_id);
            }
        }
        return $role;
    }

    public function savepermisos($data)
    {
        $objeto = json_decode($data);
        if (!empty($objeto->permisos)) {
            foreach ($objeto->permisos as $val) {
                $valor = Permisos::where('role_id', '=', $objeto->role)
                ->where('action_id', '=', $val->action_id)
                ->update([
                    'lee'      => $val->lee === 'true' || $val->lee === true? 'true' : 'false',
                    'escribe'  => $val->escribe === 'true' || $val->escribe === true? 'true' : 'false',
                    'modifica' => $val->modifica === 'true' || $val->modifica === true? 'true' : 'false',
                    'borra'    => $val->borra === 'true' || $val->borra === true? 'true' : 'false'
                ]);
            }
        }
        return $objeto->permisos;
    }

}
