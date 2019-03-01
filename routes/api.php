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

Route::get('usuarios/search/{usuario}', 'UsersController@search')->name('usuarios.search');
Route::resource('usuarios', 'UsersController');

Route::resource('traslados', 'TrasladosController');

Route::resource('reservas', 'ReservasController');

Route::resource('autorizaciones', 'AutorizacionController');

Route::resource('files', 'FilesController');

Route::resource('roles', 'RolesController');

Route::resource('gerencias', 'GerenciasController');

Route::resource('proveedores', 'ProveedoresController');

Route::get('textonimage','ImageController@textOnImage')->name('textOnImage');

Route::get('testing',function(){
require '../vendor/autoload.php';
	// dispatch(new JobNuevaReserva());
	// broadcast(new JobNuevaReserva());

	// Create image
	// $image = new \NMC\ImageWithText\Image('/storage/avats/user-default.png');
	$image = new \NMC\ImageWithText\Image('/public/storage/avats/firma1sps.png');

	// // Add text to image
	// $text1 = new \NMC\ImageWithText\Text('Thanks for using our image text PHP library!', 3, 25);
	// $text1->align = 'left';
	// $text1->color = 'FFFFFF';
	// $text1->font = 'fonts/Ubuntu-Medium.ttf';
	// $text1->lineHeight = 36;
	// $text1->size = 24;
	// $text1->startX = 40;
	// $text1->startY = 40;
	// $image->addText($text1);

	// // Add more text to image
	// $text2 = new \NMC\ImageWithText\Text('No, really, thanks!', 1, 30);
	// $text2->align = 'left';
	// $text2->color = '000000';
	// $text2->font = 'fonts/Ubuntu-Medium.ttf';
	// $text2->lineHeight = 20;
	// $text2->size = 14;
	// $text2->startX = 40;
	// $text2->startY = 140;
	// $image->addText($text2);

	// Render image
	$image->render('destination.jpg');

	// return response()->json([
	// 	// 'Reservas'      => $reserva,
	// 	// 'User'      => $gerente,

	// ], 200);

});


