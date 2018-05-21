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

Route::get('/vofertas', function () {
    return view('vofertas');
});

/**
 * Mapeamos todas las funciones que vienen predeterminadas del resource
 */
Route::resource('ofertas', 'OfertaController');

/**
 * Con esta ruta conseguiremos saber el rol del usuario siempre que lo necesitemos
 */
Route::get('/isEmpleado/{id}', 'UsersController@getRoleUserById');