<?php
Route::get('/', function(){
    return view('app');
});

Route::get('/portf', function () {
    return view('portfolio');
}); 

Route::get('/dash', function () {
    return view('crudUsuarioProyectos');
}); 
Route::get('/pruebaRegistro', function () {
    return view('includes.register');
}); 

/**
 * Temporal para hacer pruebas con las ofertas empresa
 */
Route::get('/vofertas', function () {
    return view('vofertas');
});

Route::group(['middleware' => 'auth'], function () {
    // Nos devuelve a nuestro Perfil
    Route::get('/perfil', function () {
        return view('perfil');
    });
    // Formulario para hacer un protfolio
    Route::get('/formulario', function () {
        return view('formularioPortfolio');
    });
});

Route::group(['middleware' => 'isEmpresa'], function () {
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

});

Route::group(['middleware' => 'isSolicitante'], function () {
    

    /**
     * Temporal para hacer pruebas con las inscrtipciones 
     */
    Route::get('/vinscripcionesolicitante', function () {
        return view('vinscripcionesolicitante');
    });

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

/**
 * Método que nos devolvera todas las ofertas a las que se ha inscrito un usuario
 */
Route::get('ofertas/inscripcion/user/{id}', 'OfertaController@getOfertasByInscripcionUser');

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

/**
 * Borrar la inscripcion de un usuario y esta oferta
 */
Route::delete('inscripcion/{id}', 'InscripcionesController@deleteInscripcion');

/**
 * Borrar la inscripcion de un usuario y esta oferta
 */
Route::get('inscripcion/aceptar/{id}', 'InscripcionesController@aceptarInscripcion');

/**
 * Borrar la inscripcion de un usuario y esta oferta
 */
Route::get('inscripcion/rechazar/{id}', 'InscripcionesController@rechazarInscripcion');

/**
 * Borrar la inscripcion de un usuario y esta oferta
 */
Route::get('inscripcion/empresas', 'InscripcionesController@getInscripcionesEmpresa');


/*************** ROUTINGS PERFILES ************** */
/**************************************************** */

/**
 * Nos devuelve nuestro perfil (Por el id de usuario)
 */
Route::get('perfil/usuario/{idUser}', 'PerfilController@getPerfilByUserId');


/**
 * Para crear un perfil
 */
Route::post('iperfil', 'PerfilController@store');

/**
 * Para actualizar un perfil
 */
Route::put('iperfil/{id}', 'PerfilController@store');


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
Route::get('pillaridportf/{id}', 'PortfolioController@getPortfIdJoint'); //esto es para obtener el id del portfolio a traves del id de perfil (para redirigir al user para crear proyectos)
Route::get('useridProyecto/{id}', 'ProyectosController@getidproyecto');
Route::get('useridPerfils/{id}', 'PerfilController@getidperfils');

//RUTAS PROYECTOS
Route::resource('proyectos', 'ProyectosController', ['except' => 'create']); //todas las rutas de proyectos
Route::get('projct/{id}', 'ProyectosController@getProyectosById'); //obtener los proyectos por el id de portfolio
Route::get('detail/{id}', 'ProyectosController@getDetalleProyectoById'); //obtener los datos de un proyecto con el id de proyecto

//RUTAS ENLACES
/**
 * obtener los enlaces por el id del usuario
 */
Route::get('enlaces/{id}', 'EnlacesController@getEnlacesByUserId');
Route::get('enlace/{id}', 'EnlacesController@getEnlaceById');

/**
 * Para crear un enlace
 */
Route::post('ienlace', 'EnlacesController@store');

/**
 * Para actualizar un enlace
 */
Route::put('ienlace/{id}', 'EnlacesController@update');

/**
 * Borrar la inscripcion de un usuario y esta oferta
 */
Route::delete('deleteEnlace/{id}', 'EnlacesController@destroy');