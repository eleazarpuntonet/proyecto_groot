<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('proveedores','ItWebServicesController');

Route::resource('sites','sitesController');

Route::resource('credenciales','credentialsController');

Route::resource('facturacion','factController');

// Route::get('user',function(){

// 	$user = new App\User;
// 	$user->name = 'Eleazar';
// 	$user->email = 'eleazar@miweb.com';
// 	$user->last_name = 'Ortega';
// 	$user->username= "ortegao";
// 	$user->password = bcrypt('123123');
// 	$user->save();

// 	$user = new App\Proveedor;
// 	$user->nombre = 'Dongee';
// 	$user->cuenta = '10256320';
// 	$user->usuario = 'it@spservicesltd.uk';
// 	$user->password= "sps#12312345";
// 	$user->comentarios= "Primera cuenta de Proveedores";
// 	$user->save();

// 	$user = new App\Sites;
// 	$user->dominio = 'spservices.com';
// 	$user->hosting = '1';
// 	$user->ip_site = '192.192.192.0';
// 	$user->status= "ACTIVO";
// 	$user->save();

// 	$user = new App\Credenciales;
// 	$user->id_site = '1';
// 	$user->descripcion = 'fasdfasdf';
// 	$user->user = 'admin';
// 	$user->passw= "admin49";
// 	$user->comentarios= "ACTIVO";
// 	$user->save();

// 	$user = new App\Facturacion;
// 	$user->id_proveedor = '1';
// 	$user->servicio = 'Hosting';
// 	$user->ciclo_facturacion = 'Anual';
// 	$user->fecha_corte= "Manana";
// 	$user->importe= "9852";
// 	$user->save();

// 	return $user;
// });


Auth::routes();

Route::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);

Route::get('/ajaxHost',['uses'=>'ajaxController@hosts']);

Route::get('/ajaxSites',['uses'=>'ajaxController@sites']);


