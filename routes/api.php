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
use App\Viaticos;
use App\Notifications\Notificaciontest;

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

Route::resource('traslados', 'TrasladosController');

Route::resource('reservas', 'ReservasController');

Route::resource('autorizaciones', 'AutorizacionController');

Route::get('estadoslist','metacontroller@ve_estados')->name('metacontroller.ve_estados');

Route::get('estadoslist/{id_estado}','metacontroller@ve_ciudades')->name('metacontroller.ve_ciudades');

Route::get('testing',function(){

	$reserva = Reservas::find(15);
	$user = User::find(1);

	$mensaje = 'Primera notificacion';
	// $user->notify(new Notificaciontest($mensaje));
	// $autorizacion            = new Autorizaciones;
	// $autorizacion->recurso   = 'Viatico';
	// $autorizacion->valor     = 'Aprobado';
	// $autorizacion->date_auth = date('Y-m-d H:i:s');
	// $reserva->autorizaciones()->save($autorizacion);
	$id = 15;
	// $autorizacion =Reservas::whereHas('autorizaciones',function($query) use ($id){
	// 	$query->where('id', '=', 4);
	// })->get(['id']);
	// $autorizacion->recurso   = 'Reserva';
	// $autorizacion->valor     = 'Negada';
	// $autorizacion->date_auth = date('Y-m-d H:i:s');
	// $autorizacion->save();

	// $reserva->autorizaciones()->save($autorizacion);


	// $reservas = User::with([
	//     // 'autorizaciones:autorizable_id,gerencia',
	//     // 'fullname',
	//     // 'autorizaciones:autorizable_id,recurso,valor,date_auth',
	//     // 'user.departamento.coordinador:id,name,last_name,cargo,avatar',
	//     // 'user.departamento.gerente:id,name,last_name,cargo,avatar',
	//     // 'traslados',
	// ])->find(1);

	return response()->json([
		'Reservas'      => $reserva,
		'User'      => $user->departamento,

	], 200);

})->middleware('auth:api');

