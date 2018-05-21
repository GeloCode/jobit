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
    public function index()
    {
        return Oferta::orderBy('created_at', 'DESC')->get();
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
    public function getOfertaByUser($id)
    {
        return Oferta::where('user_id', $id)->get();
    }

    /**
     * Devuelve las ofertas que esten en la província X
     */
    public function getOfertaByProvincia($id)
    {
        return Oferta::where('provincia_id', $id)->get();
    }

    /**
     * Devuelve las ofertas que coincidan con la palabra clave en el titulo o en la descripcion
     */
    public function searchOferta($word)
    {
        return Oferta::where('titulo', 'like', '%'.$word.'%')
        ->orWhere('descripcion', 'like', '%'.$word.'%');
    }

    /**
     * Devuelve las ofertas que coincidan con la palabra clave y una provincia
     */
    public function searchOfertaByProvinciaAndWord($id, $word)
    {
        return Oferta::where([['provincia_id', $id], ['titulo', 'like', '%'.$word.'%']])
        ->orWhere([['provincia_id', $id], ['descripcion', 'like', '%'.$word.'%']])->get();
    }
}
