<?php

use Illuminate\Http\Request;
use App\Ciudadesve;
use App\Estadosve;
use App\Municipiosve;
use App\User;
use App\Role;
use App\AssignedTableRoles;
use App\Reservas;
use App\Autorizaciones;
use App\Traslados;
use App\Departamentos;
use App\Proveedor;
use App\Contactos;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login',   'AuthController@login');
    Route::post('logout',  'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me',      'AuthController@me');

});

Route::resource('proveedores','ItWebServicesController');

Route::resource('sites','sitesController');

Route::resource('usuarios', 'UsersController');

Route::resource('reservas', 'ReservasController');

Route::get('estadoslist','metacontroller@ve_estados')->name('metacontroller.ve_estados');

Route::get('estadoslist/{id_estado}','metacontroller@ve_ciudades')->name('metacontroller.ve_ciudades');

Route::get('testing',function(){

	$proveedor                  = Proveedor::where('nombre', '=', 'GoDaddy')->delete();
	$proveedor                  = new Proveedor;
	$proveedor->nombre          = 'GoDaddy';
	$proveedor->r_social        = 'godaddy.com';
	$proveedor->rif             = 'J-1212121';
	$proveedor->t_contribuyente = 'Normal';
	$proveedor->dir             = 'Bla bla bla bla bla';
	$proveedor->autor           = 1;
	$proveedor->save();

	$contacto         = Contactos::where('nombre', '=', 'Alguien contesta')->delete();
	$contacto         = new Contactos;
	$contacto->nombre = 'Alguien contesta';
	$contacto->medio  = 'Email';
	$contacto->value  = 'Alguien@gmail.com';
	$contacto->save();
	$proveedor_       = Proveedor::find($proveedor->id)->contacto()->save($contacto);
	

	$reserva                = Reservas::where('alcance', '=', 'Nacional')->delete();
	$reserva                = new Reservas;
	$reserva->id_user       = 1;
	$reserva->alcance       = 'Nacional';
	$reserva->origen_a      = 'Caracas';
	$reserva->origen_b      = 'San Martin';
	$reserva->origen_det    = 'Av San Martin';
	$reserva->fecha_partida = '2018-08-30 00:28:08';
	$reserva->fecha_retorno = '2018-09-17 21:03:31';
	$reserva->destino_a     = 'Bolivar';
	$reserva->destino_b     = 'Paraguana';
	$reserva->destino_det   = '8 Becker Lane';
	$reserva->motivo        = 'Rumba';
	$reserva->agenda        = 'Rumbear mucho';
	$reserva->save();

	$depto                  = Departamentos::where('ref', '=', 'IT')->delete();
	$depto                  = new Departamentos;
	$depto->disp_name       = 'Information Techology';
	$depto->ref             = 'IT';
	$depto->gerente_id      = 1;
	$depto->coordinador_id  = 2;
	$depto->dependencia     = 'Caracas';
	$depto->save();
	

	$auth                   = Autorizaciones::where('depto_id', '=', $depto->id)->delete();
	$auth                   = new Autorizaciones;
	$auth->date_auth        = '2018-06-22 12:21:03';
	$auth->depto_id         = $depto->id;
	$auth->reserva_id       = $reserva->id;
	$auth->save();

	$traslado = Traslados::where('tipo','=','terrestre')->delete();
	$traslado              = new Traslados;
	$traslado->reservas_id = $reserva->id;
	$traslado->tipo        = 'Terrestre';
	$traslado->origen      = 'Direccion 1';
	$traslado->destino     = 'Direccion 2';
	$traslado->servicio    = 'Taxi';
	$traslado->proveedor   = $proveedor->id;
	$traslado->session     = 1;
	$traslado->save();
	$reserva_ 	  = Reservas::find($reserva->id)->traslados()->save($traslado);
	
	$reserva_     = Reservas::with([
		'traslados',
		'autorizaciones.gerencia.coordinador',
		'autorizaciones.gerencia.gerente',
		'autorizaciones.reservas',
		'user'])->find($reserva->id);
	$departamento = Departamentos::with('autorizaciones')->find($depto->id);
	$autorizacion = Autorizaciones::with(['reservas', 'gerencia'])->find($auth->id);
	$traslados    = Traslados::with(['proveedor','reservas'])->find($traslado->id);
	$proveedor_   = Proveedor::with(['traslado','contacto'])->find($proveedor->id);
	// dd($reserva_);
	return response()->json([
		'Reserva'      => $reserva_,
		// 'Departamento' => $departamento,
		// 'Autorizacion' => $autorizacion,
		// 'Traslados'    => $traslados,
		// 'Proveedor'    => $proveedor_,
	], 200);

})->middleware('auth:api');

