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
use App\Tableauthrole;
use App\ActionsAuth;
use App\Notifications\Notificaciontest;
use App\Jobs\JobNuevaReserva;

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

Route::get('usuarios/actionsauth/{usuario}', 'UsersController@actions_auth')->name('usuarios.actionsauth');

Route::get('usuarios/search/{usuario}', 'UsersController@search')->name('usuarios.search');

Route::get('usuarios/path_auth/{usuario}', 'UsersController@path_auth')->name('usuarios.paths');

Route::resource('usuarios', 'UsersController');

Route::resource('traslados', 'TrasladosController');

Route::resource('reservas', 'ReservasController');

Route::resource('autorizaciones', 'AutorizacionController');

Route::resource('files', 'FilesController');

Route::post('roles/pathauth/{role}', 'RolesController@path_auth')->name('roles.Authpath');

Route::resource('roles', 'RolesController');

Route::resource('gerencias', 'GerenciasController');

Route::resource('proveedores', 'ProveedoresController');

Route::post('textonimage/{user}', 'ImageController@textOnImage')->name('textOnImage');

Route::get('testing',function(){

	return response()->json([
		'Path'      => Tableauthrole::with('actions')->find('dataload003i'),
		'Paths'      => ActionsAuth::get()

	], 200);

});


