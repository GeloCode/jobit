<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar       = $request->buscar      == '' ? '' : $request->buscar;
        $provincia    = $request->provincia   == '0' ? '' : $request->provincia;
        $sueldoDesde  = $request->sueldoDesde == '' ?  0  : $request->sueldoDesde;
        $sueldoHasta  = $request->sueldoHasta == '' ? Oferta::max('sueldo_hasta') : $request->sueldoHasta;
        $id = $request->id;
        
        if($provincia == ''){
            $ofertas = Oferta::orderBy('created_at', 'DESC')->where(function ($query) use ($buscar){
                $query->where('titulo', 'like', '%'.$buscar.'%')
                ->orWhere('descripcion', 'like', '%'.$buscar.'%');})
            ->where('sueldo_desde', '>=', $sueldoDesde)->where('sueldo_hasta', '<=', $sueldoHasta)
            ->whereNotIn('id', function ($query) use ($id){
                $query->select('oferta_id')->from('inscripcions')->where('user_id', "=", $id);
            })->paginate(2); 
        } else {
            $ofertas = Oferta::orderBy('created_at', 'DESC')->where('provincia_id', '=', $provincia)
            ->where(function ($query) use ($buscar){
                $query->where('titulo', 'like', '%'.$buscar.'%')
                ->orWhere('descripcion', 'like', '%'.$buscar.'%');})
            ->where('sueldo_desde', '>=', $sueldoDesde)->where('sueldo_hasta', '<=', $sueldoHasta)->paginate(2); 
        }
              
        
        return [
            'pagination' => [
                'total'        => $ofertas->total(),
                'current_page' => $ofertas->currentPage(),
                'per_page'     => $ofertas->perPage(),
                'last_page'    => $ofertas->lastPage(),
                'from'         => $ofertas->firstItem(),
                'to'           => $ofertas->lastItem(),
            ],
            'ofertas' => $ofertas
        ];
    }

    /**
     * Nos devuelve una oferta dependiendo de la id que le pasemos
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOfertaById($id)
    {
        return Oferta::find($id);
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
            'provincia_id' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'sueldo_desde' => 'required',
            'sueldo_hasta' => 'required',
        ]);

        Oferta::create($request->all());

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Oferta::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'provincia_id' => 'required',
            'titulo'       => 'required',
            'descripcion'  => 'required',
            'sueldo_desde' => 'required',
            'sueldo_hasta' => 'required',
        ]);

        Oferta::findOrFail($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oferta = Oferta::find($id);
        $oferta->delete();
    }

    /**
     * Devuelve las ofertas que sean de X usuario
     */
    public function getOfertaByUser(Request $request)
    {
        $buscar       = $request->buscar      == ''  ? '' : $request->buscar;
        $provincia    = $request->provincia   == '0' ? '' : $request->provincia;
        $id = $request->id;

        if($provincia == ''){
            $ofertas = Oferta::orderBy('created_at', 'DESC')->where(function ($query) use ($buscar){
                $query->where('titulo', 'like', '%'.$buscar.'%')
                ->orWhere('descripcion', 'like', '%'.$buscar.'%');})
                ->where('user_id', $id)->paginate(1); 
        } else {
            $ofertas = Oferta::orderBy('created_at', 'DESC')->where('provincia_id', '=', $provincia)
            ->where(function ($query) use ($buscar){
                $query->where('titulo', 'like', '%'.$buscar.'%')
                ->orWhere('descripcion', 'like', '%'.$buscar.'%');})
                ->where('user_id', $id)->paginate(1); 
        }
        return [
            'pagination' => [
                'total'        => $ofertas->total(),
                'current_page' => $ofertas->currentPage(),
                'per_page'     => $ofertas->perPage(),
                'last_page'    => $ofertas->lastPage(),
                'from'         => $ofertas->firstItem(),
                'to'           => $ofertas->lastItem(),
            ],
            'ofertas' => $ofertas,
            'buscar' => $buscar,
            'provincia' => $provincia,
        ];
    }

    public function getOfertasByInscripcionUser($id){
        return Oferta::whereIn('ofertas.id', function ($query) use ($id){
            $query->select('oferta_id')
            ->from('inscripcions')
            ->where('user_id', '=', $id)
            ->orderBy('created_at', 'DESC');
        })->leftJoin('inscripcions', 'ofertas.id', '=', 'inscripcions.oferta_id')->get();
    }
}
