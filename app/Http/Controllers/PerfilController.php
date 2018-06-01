<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
class PerfilController extends Controller
{
    /**
     * Nos devuelve una Perfil dependiendo de la id que le pasemos
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPerfilByUserId($id)
    {
        return Perfil::where('user_id', $id)->first();
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
            'portfolio_id' => 'required',
            'provincia_id' => 'required',
            'name' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'lenguajes' => 'required',
            'frameworks' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        Perfil::create($request->all());

        return;
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
            'user_id' => 'required',
            'portfolio_id' => 'required',
            'name' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'lenguajes' => 'required',
            'frameworks' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        Perfil::findOrFail($id)->update($request->all());
        return;
    }
}
