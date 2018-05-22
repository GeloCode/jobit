<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia;

class ProvinciasController extends Controller
{
    /**
     * Devuelve todas las provincias
     */
    public function index()
    {
        return Provincia::orderBy('id', 'ASC')->get();
    }
}
