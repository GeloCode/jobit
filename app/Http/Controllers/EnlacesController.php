<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;
use App\Enlace;
class EnlacesController extends Controller
{
    
    /**
     * Nos devuelve los enlaces  dependiendo de la id que le pasemos
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEnlacesByUserId($id)
    {
        if(Perfil::where('user_id', '<>', 0)){
            return Enlace::where('user_id', $id)->get();
        }else{

        }
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
            'web' => 'required',
            'enlace' => 'required',
        ]);
        
        if(Enlace::where('id', '=', $request -> id)->count() > 0)
        {
            Enlace::where('user_id', '=', $request -> user_id ) -> update( $request -> all() );
        } else {
            Enlace::create($request->all());
        }
        return;
    }
    /**
     * Borrar un enlace
     */
    public function deleteEnlace($id)
    {
        $enlace = Enlace::findOrFail($id);
        $enlace -> delete();
    }
}
