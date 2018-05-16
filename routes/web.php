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

Route::get('/', function () {
    return view('app');
});

Route::get('/superofertas', function() {
    return view('ofertas.ofertas');
});

/**
 *  Se mapean automaticamente todas las funciones resource del controlador de oferta.
 */
Route::resource('ofertas', 'OfertaController');

/**
 *  Se mapean automaticamente todas las funciones resource del controlador de user.
 */
Route::resource('users', 'UserController');

/**
 *  Cuando llamemos a esta ruta por axios nos devolverá un JSON con todas las ofertas para ese usuario.
**/
Route::get('/getOfertasByUserId/{id}', 'OfertaController@getOfertasByUserId');

/**
 *  Cuando llamemos a esta ruta por axios nos devolverá booleana para saber si es empresa o no.
**/
Route::get('/userEsEmpresa/{id}', 'UserController@esEmpresa');
