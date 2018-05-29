<?php
Route::get('/', function(){
    return view('app');
});

Route::get('/portf', function () {
    return view('portfolio');
}); 

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/isEmpleado/{id}', 'UsersController@getRoleUserById');

/**
 * Nos devuelve los roles con la paginacion buscando por un criterio y una palabra
 */
Route::get('/rol', 'RoleController@index');

/**
 * Devuelve todos los roles que estén activos ordenados por el nombre
 */
Route::get('rol/getRoles', 'RoleController@getRoles');

/**
 * Routings del login/register
 */
Auth::routes();

/**
 * Temporal para hacer pruebas con las ofertas 
 */
Route::get('/vofertas', function () {
    return view('vofertas');
});
/**
 * Temporal para hacer pruebas con las ofertas empresa
 */
Route::get('/vofertasempresa', function () {
    return view('vofertasempresa');
});

/**
 * Temporal para hacer pruebas con las inscrtipciones 
 */
Route::get('/vinscripcionesempresa', function () {
    return view('vinscripcionesempresa');
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
Route::get('ofertas/usuario/', 'OfertaController@getOfertaByUser');

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

/**
 * Nos devuelve todas las inscripciones para X usuario (Para ver nuestras inscripciones si somos empresa)
 */
Route::get('inscripciones/usuario/{idUser}', 'InscripcionesController@getInscripcionesByUser');


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


//PROYECTOS 
Route::get('projects', function () {
    return view('proyectos');
});
//DETALLE DEL PROYECTO
Route::get('detailProject', function(){
    return view('detalleProyecto');
});

//RUTAS PORTFOLIOS
Route::resource('portfolios', 'PortfolioController', ['except' => 'create']); //todas las rutas portfolios
Route::get('portfolios', 'PortfolioController@getPortfolios'); //obtener todos los portfolios
Route::get('selectName', 'PortfolioController@getNameUser'); //obtener todos los usuarios para poder printarlos es portfolios
Route::post('crearPortfolio', 'PortfolioController@store'); //crear el portfolio
Route::get('info/{id}', 'PortfolioController@getInfoPortfolio');

//RUTAS PROYECTOS
Route::resource('proyectos', 'ProyectosController', ['except' => 'create']); //todas las rutas de proyectos
Route::get('projct/{id}', 'ProyectosController@getProyectosById'); //obtener los proyectos por el id de portfolio
Route::get('detail/{id}', 'ProyectosController@getDetalleProyectoById'); //obtener los datos de un proyecto con el id de proyecto


