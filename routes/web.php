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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/isEmpleado/{id}', 'UsersController@getRoleUserById');

Route::get('/rol', 'RoleController@index');
Route::get('rol/getRoles', 'RoleController@getRoles');
Auth::routes();

/**
 *  Temporal para hacer pruebas con las ofertas 
 */
Route::get('/vofertas', function () {
    return view('vofertas');
});

/**
 * Nos devuelve todas las ofertas sin filtar por nada
 */
Route::get('ofertas', 'OfertaController@index');

/**
 * Nos devuelve la oferta con X id
 */
Route::get('oferta/{id}', 'OfertaController@getOfertaById');

/**
 * Nos devuelve todas las ofertas filtradas para X usuario (Para ver nuestras ofertas si somos empresa)
 */
Route::get('ofertas/usuario/{idUser}', 'OfertaController@getOfertaByUser');

/**
 * Nos devuelve todas las ofertas filtradas por la provincia que buscamos
 */
Route::get('ofertas/provincia/{idProvincia}', 'OfertaController@getOfertaByProvincia');

/**
 * Nos devuelve todas las ofertas filtradas por la palabra que buscamos
 */
Route::get('ofertas/palabra/{word}', 'OfertaController@searchOferta');

/**
 * Nos devuelve todas las ofertas filtradas por la palabra que buscamos y su provincia
 */
Route::get('ofertas/provincia/{idProvincia}/palabra/{word}', 'OfertaController@searchOfertaByProvinciaAndWord');

/**
 * Para eliminar ofertas (Para las empresas)
 */
Route::delete('ofertas/{id}', 'OfertaController@destroy');

/**
 * Para crear una oferta (Para las empresas)
 */

Route::post('oferta', 'OfertaController@store');

/**
 * Para editar una oferta (Para las empresas)
 */
Route::put('oferta/{id}', 'OfertaController@update');


/*************** ROUTINGS PROVINCIAS ***************** */
/**************************************************** */

/**
 * Nos devuelve todas las provincias sin filtar por nada
 */
Route::get('provincias', 'ProvinciasController@index');

/*************** ROUTINGS INSCRIPCIONES ************** */
/**************************************************** */

/**
 * Nos devuelve todas las inscripciones sin filtar por nada
 */
Route::get('inscripciones', 'InscripcionesController@index');

/**
 * Para crear una inscripcion (Para los Solicitantes)
 */
Route::post('inscripcion', 'InscripcionesController@store');

/*************** ROUTINGS PERFILES ************** */
/**************************************************** */

/**
 * Nos devuelve nuestro perfil (Por el id de usuario)
 */
Route::get('perfil/usuario/{idUser}', 'PerfilController@getPerfilByUserId');

/**
 * Para crear un perfil
 */
Route::post('perfil', 'PerfilController@store');

/**
 * Para actualizar un perfil
 */
Route::put('perfil/{id}', 'PerfilController@update');