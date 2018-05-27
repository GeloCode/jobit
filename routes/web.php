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
    return view('portfolio');
}); 
Route::get('projects', function () {
    return view('proyectos');
});


//RUTAS PORTFOLIOS
Route::resource('portfolios', 'PortfolioController', ['except' => 'create']); //todas las rutas portfolios
Route::get('portfolios', 'PortfolioController@getPortfolios'); //obtener todos los portfolios
Route::get('selectName', 'PortfolioController@getNameUser'); //obtener todos los usuarios para poder printarlos es portfolios
Route::post('crearPortfolio', 'PortfolioController@store'); //crear el portfolio
Route::get('info/{id}', 'PortfolioController@getInfoPortfolio');

//RUTAS PROYECTOS
Route::resource('proyectos', 'ProyectosController', ['except' => 'create']); //todas las rutas de proyectos
Route::get('projct/{id}', 'ProyectosController@getProyectosById'); //obtener los proyectos



