<?php
namespace App\Http\Controllers;
use App\Notificationtests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
        // $this->middleware('auth:api');
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $credentials['is_verified'] = 1;
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'No autorizado'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function register(Request $request)
    {
        $credentials = $request->only('nombre','snombre','pass1', 'email');
        
        $rules = [
            'nombre' => 'required|max:255',
            'snombre' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];

        $nombre   = $request->nombre;
        $snombre  = $request->snombre;
        $email    = $request->email;
        $password = $request->pass1;
        $usuario  = User::where([ 'email'=>$email , 'is_verified'=>0])->get();
        if (is_null($usuario->first())) {
            $user                  = new App\User;
            $user->name            = ucwords(strtolower($nombre));
            $user->last_name       = ucwords(strtolower($snombre));
            $user->codigo_empleado = 'n/a';
            $user->ci_usuario      = 'n/a';
            $user->cargo           = 'n/a';
            $user->gerencia        = 'n/a';
            $user->fecha_ing       = 'n/a';
                $user->sexo        = 'n/a';
                $user->sede            = 'n/a';
                $user->avatar          = 'n/a';
                $user->email           = $email;
            $user->status          = 'NEW';
            $user->password        = bcrypt($password);
            $user->save();

            $verification_code = str_random(30); //Generate verification code
            DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
            $subject = "Confirmacion de correo electronico";

            // Se envia correo con el CODIGO DE CONFIRMACION

            return response()->json([
                'success'=> true, 
                'message'=> 'Usuario creado exitosamente',
                'user' => $user],200);      
        } else {
            $nuser = $usuario->first();
            if ($nuser->is_verified == 1) {
                return response()->json([
                    'success'=> false, 
                    'message'=> 'El correo que ingreso ya existe en nuestros registros'],201);
            } else {
                $nuser->update([
                    'name'      => $nombre,
                    'last_name'  => $snombre,
                    'password' => bcrypt($password)
                ]);    
                $verification_code = str_random(30); //Generate verification code
                DB::table('user_verifications')->insert(['user_id'=>$nuser->id,'token'=>$verification_code]);
                $subject = "Confirmacion de correo electronico";

            // Se envia correo con el CODIGO DE CONFIRMACION

                return response()->json([
                    'success'=> true, 
                    'message'=> 'Usuario actualizado exitosamente',
                    'user' => $nuser],200);            
            }
        }
    }

    public function verify(Request $request)
    {
        // $credentials = $request->only('email', 'nombre', 'snombre', 'pass1');
        // return $this->respondWithToken($this->guard()->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        
        if ($this->guard()->user()->id === 1) {
            $user_notif = Notificationtests::all();
        } else {
            $user_notif = $this->guard()->user()->notifications;
        }
        return response()->json([
            'access_token'  => $token,
            'roles'         => $this->guard()->user()->roles,
            'permisos'         => $this->guard()->user()->permisos,
            'gerencia'      => $this->guard()->user()->departamento,
            'notifications' => $user_notif,
            'user'          => $this->guard()->user(),
            'token_type'    => 'bearer',
            'expires_in'    => $this->guard()->factory()->getTTL() * (60 * 4)
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}