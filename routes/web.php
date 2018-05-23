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

Route::resource('portfolios', 'PortfolioController', ['except' => 'create']);
Route::get('portfolios', 'PortfolioController@getPortfolios');
Route::post('crearPortfolio', 'PortfolioController@store');


