<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notificationtests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Mail;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','verifyUser']]);
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
        $fromail = 'eleazar.sb18@gmail.com';
        $fromname = 'Southern Procurement Services, LTD test mail';
        $subject = "Confirmacion de correo electronico";
        $credentials = $request->only('nombre','snombre','pass1', 'email');
        $nombre   = $request->nombre;
        $snombre  = $request->snombre;
        $email    = $request->email;
        $password = $request->pass1;
        $fullname = $nombre.' '.$snombre;
        $usuario  = User::where([ 'email'=>$email , 'is_verified'=>0])->get();
        if (is_null($usuario->first())) {
            $user                  = new User;
            $user->name            = ucwords(strtolower($nombre));
            $user->last_name       = ucwords(strtolower($snombre));
            $user->codigo_empleado = 'n/a';
            $user->ci_usuario      = 'n/a';
            $user->cargo           = 'n/a';
            $user->gerencia        = 'n/a';
            $user->fecha_ing       = now();
            $user->sexo            = 'n/a';
            $user->sede            = 'n/a';
            $user->avatar          = 'n/a';
            $user->email           = $email;
            $user->status          = 'NEW';
            $user->password        = bcrypt($password);
            // $user->save();
            $verification_code = str_random(30); //Generate verification code
            DB::table('user_verifications')->insert(['user_id'=>1,'token'=>$verification_code]);
            // DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);

            Mail::send('email', [
                'name' => $fullname, 
                'verification_code' => $verification_code],
                function($mail) use ($email, $fullname, $subject, $fromail,$fromname){
                    $mail->from($fromail, $fromname);
                    // $mail->to($email, $fullname);
                    $mail->to('it@spservicesltd.uk', $fullname);
                    $mail->subject($subject);
                });
            return response()->json([
                'success'=> true, 
                'message'=> 'Usuario creado exitosamente',
                'user' => $user],200);      
        } else {
            $nuser = $usuario->first();
            if ($nuser->is_verified == 1) {
                return response()->json([
                    'success'=> false, 
                    'message'=> 'El correo que ingreso ya existe en nuestros registros'],498);
            } else {
                // $nuser->update([
                //     'name'      => $nombre,
                //     'last_name'  => $snombre,
                //     'password' => bcrypt($password)
                // ]);    
                $verification_code = str_random(30); //Generate verification code
                DB::table('user_verifications')->insert(['user_id'=>$nuser->id,'token'=>$verification_code]);
                Mail::send('email', ['name' => $fullname, 'verification_code' => $verification_code],
                    function($mail) use ($email, $fullname, $subject, $fromail,$fromname){
                        $mail->from($fromail, $fromname);
                        $mail->to($email, $fullname);
                        $mail->subject($subject);
                    });
                return response()->json([
                    'success'=> true, 
                    'message'=> 'Usuario actualizado exitosamente',
                    'user' => $nuser],200);            
            }
        }
    }

    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ],299);
            }
            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'message'=> 'You have successfully verified your email address.'
            ],200);
        }
        return response()->json([
            'error'=> "Verification code is invalid."
        ],499);
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