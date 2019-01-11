<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Reservas;
use App\Viaticos;
use App\Autorizaciones;

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

        $reservas = Reservas::with([
            'autorizaciones',
            'user.departamento',
            'user.departamento.coordinador',
            'user.departamento.gerente',
            'traslados',
        ])->paginate();
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

        $reserva                = new Reservas;
        $reserva->id_user       = $request->input('id_user');
        $reserva->alcance       = $request->input('alcance');
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
        $reserva->save();

        $autorizacion             = new Autorizaciones;
        $autorizacion->recurso    = 'Reserva';
        $autorizacion->valor      = 'Standby';
        $autorizacion->depto_id   = $user->departamento->id;
        $autorizacion->reserva_id = $reserva->id;
        $autorizacion->date_auth  = date('Y-m-d H:i:s');
        $reserva->autorizaciones()->save($autorizacion);

        $autorizacion             = new Autorizaciones;
        $autorizacion->recurso    = 'Viatico';
        $autorizacion->valor      = 'Standby';
        $autorizacion->depto_id   = $user->departamento->id;
        $autorizacion->reserva_id = $reserva->id;
        $autorizacion->date_auth  = date('Y-m-d H:i:s');
        $reserva->autorizaciones()->save($autorizacion);
        
        if (!empty($request->input('viaticos'))) {

            foreach ($request->input('viaticos') as $x => $val) {
                $viatico           = new Viaticos;
                $viatico->rubro    = $val['rubro'];
                $viatico->cantidad = $val['dias'];
                $viatico->val_unit = $val['val_unit'];
                Reservas::find($reserva->id)->viaticos()->save($viatico);

            }
        }
        return Reservas::with(['viaticos','autorizaciones'])->find($reserva->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $userid = $user->id;
        /*
        * Busca en la tabla Autorizaciones los registros de esta reserva
        * donde el COORDINADOR de los departamentos sean igual al usuario logueado
        */
        $coordinador = Autorizaciones::where('autorizable_id','=',$id)
            ->whereHas('gerencia', function($query) use ($userid){
                $query->whereHas('coordinador', function($query) use ($userid){
                        $query->where('id','=',$userid);
                    });
            })->get();
            
        /*
        * Busca en la tabla Autorizaciones los registros de esta reserva
        * donde el GERENTE de los departamentos sean igual al usuario logueado
        */
        $gerente = Autorizaciones::where('autorizable_id','=',$id)
            ->whereHas('gerencia', function($query) use ($userid){
                $query->whereHas('gerente', function($query) use ($userid){
                        $query->where('id','=',$userid);
                    });
            })->get();
            

        $reserva = Reservas::with([
            'viaticos',
            'viaticos',
            'traslados',
            'autorizaciones',
            'user.departamento',
            ])->findOrFail($id);
        // if (count($coordinador)>0 || count($gerente)>0) {
        if (count($coordinador)>0 || count($gerente)>0 || $userid==1) {
            return response()->json([
                'reserva' => $reserva,
                'autoreserva' => true,
                'autoviatico' => true,
            ]);
        } else {
            return response()->json([
                'reserva' => $reserva,
            ]);
        }

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
