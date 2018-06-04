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
    public function getInscripcionesEmpresa(Request $request)
    {
        $id = $request->userId;
        $ofertaId = $request->ofertaId;
        if($ofertaId){
            return Inscripcion::with('user:id,email')->with('oferta:id,titulo')
            ->whereHas('oferta', function($query) use($id, $ofertaId){
                $query->where('user_id', '=', $id)->where('id', '=', $ofertaId);
            })->orderBy('estado')->get();
        } else {
            return Inscripcion::with('user:id,email')->with('oferta:id,titulo')
            ->whereHas('oferta', function($query) use($id, $ofertaId){
                $query->where('user_id', '=', $id);
            })->orderBy('estado')->get();
        }
    }

    /**
     * Devuelve las estadísticas de las Inscripciones
     */
    public function getEstadisticasInscripcionesEmpresa($userId){        
        $totales = Inscripcion::with('oferta:id,user_id')
        ->whereHas('oferta', function($query) use($userId){
            $query->where('user_id', '=', $userId);
        })->count();

        $pendientes = $this->getInscripcionesByEmpresaEstado($userId, '-');
        $aceptados  = $this->getInscripcionesByEmpresaEstado($userId, 'A');
        $rechazados = $this->getInscripcionesByEmpresaEstado($userId, 'R');

        return ['totales'   => $totales,   'pendientes' => $pendientes, 
                'aceptados' => $aceptados, 'rechazados' => $rechazados];


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

    /**
     * Buscar inscripciones de una empresa por usuario
     */
    public function getInscripcionesByEmpresaEstado($userId, $letra){
        return Inscripcion::with('oferta:id,user_id')
        ->whereHas('oferta', function($query) use($userId){
            $query->where('user_id', '=', $userId);
        })->where('estado', '=', $letra)->count();
    }
}
