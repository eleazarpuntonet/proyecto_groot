<?php

namespace App\Http\Controllers;
use App\User;
use App\Departamentos;
use App\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function __construct(){
        // $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::with([
            'departamento',
            'roles',
        ])->get();

        return response()->json($usuarios);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $user = new User;
       $user->name              = $request->input('name');
       $user->last_name         = $request->input('last_name');
       $user->email             = $request->input('email');
       $user->codigo_empleado   = $request->input('codigo_empleado');
       $user->ci_usuario        = $request->input('ci_usuario');
       $user->cargo             = $request->input('cargo');
       $user->gerencia          = $request->input('departamento');
       // $user->sede              = $request->input('sede');
       $user->sede              = 'Caracas';
       // $user->password          = $request->input('password');
       $user->password          = bcrypt(123123);
       $user->status            = 'Activo';
       $user->save();
       $user->departamento()->save(Departamentos::find($request->input('departamento')));

       if (!empty($request->input('roles'))){
            foreach ($request->input('roles') as $x => $val) {
                $user->roles()->save(Role::find($val));
            }
        }
        return User::with([
            'departamento',
            'roles',
        ])->find($user->id);;
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

    public function search($nameorlastname)
    {
        $result = User::with('departamento')->where('name','LIKE','%'.$nameorlastname.'%')
                        ->orWhere('last_name','LIKE','%'.$nameorlastname.'%')
                        ->get();

        return $result;
        // return "retornando busqueda";
    }


}
