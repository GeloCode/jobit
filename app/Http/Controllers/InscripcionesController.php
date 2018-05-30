<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use App\Inscripcion;

class InscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inscripcion::orderBy('created_at', 'DESC')->get();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'oferta_id' => 'required'
        ]);
        
        Inscripcion::create($request->all());

        return;
    }

    /**
     * Devuelve las Inscripciones que tiene un usuario
     */
    public function getInscripcionesByUser($id)
    {
        return Inscripcion::where('user_id', $id)->get();
    }

    /**
     * Devuelve las Inscripciones de una empresa
     */
    public function getInscripcionesEmpresa($id)
    {
        return Inscripcion::with('user:id,email')->with('oferta:id,titulo')
        ->whereHas('oferta', function($query) use($id){
            $query->where('user_id', '=', $id);
        })->get();
    }

    /**
     * Borrar una inscripcion para una inscripcion
     */
    public function deleteInscripcion($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
    }

    /**
     * Aceptar inscripcion
     */
    public function aceptarInscripcion($id)
    {
        Inscripcion::findOrFail($id)->update(['estado' => 'A']);
        return;
    }

    /**
     * Rechazar inscripcion
     */
    public function rechazarInscripcion($id)
    {
        Inscripcion::findOrFail($id)->update(['estado' => 'R']);
        return;
    }
}
