<?php

use Illuminate\Http\Request;
use App\Ciudadesve;
use App\Estadosve;
use App\Municipiosve;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login',   'AuthController@login');
    Route::post('logout',  'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me',      'AuthController@me');

});

Route::resource('proveedores','ItWebServicesController');

Route::resource('sites','sitesController');

Route::resource('usuarios', 'UsersController');

Route::get('countrieslist','metacontroller@countrieslist')->name('metacontroller.countrieslist');

Route::get('citieslist/{city}','metacontroller@citieslist')->name('metacontroller.citieslist');

Route::get('estadoslist','metacontroller@ve_estados')->name('metacontroller.ve_estados');

Route::get('estadoslist/{id_estado}','metacontroller@ve_ciudades')->name('metacontroller.ve_ciudades');

// Route::get('citytesting',function(){

// 	// return Ciudadesve::with('estados')->get();
// 	// return Estadosve::with('ciudades')->get();
// 	return Estadosve::with('municipios')->get();
// 	// return Municipiosve::with('estados')->get();
// });