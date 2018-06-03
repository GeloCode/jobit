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
    public function getidperfils($authid){
        return Perfil::where('user_id', $authid)->value('user_id');
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
            'provincia_id' => 'required',
            'name' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            'lenguajes' => 'required',
            'frameworks' => 'required',
            'descripcion' => 'required',
        ]);
        
        if(Perfil::where('user_id', '=', $request->user_id)->count() > 0)
        {
            Perfil::where('user_id', '=', $request->user_id)->update($request->all());
        } else {
            Perfil::create($request->all());
        }
        return;
    }
}
