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
        return Enlace::where('user_id', $id)->get();
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
        
        Enlace::create($request->all());
        return;
    }
    public function update(Request $request){
        $this->validate($request, [
            'user_id' => 'required',
            'web' => 'required',
            'enlace' => 'required',
        ]);
        Enlace::where('user_id', '=', $request -> user_id ) -> update( $request -> all() );
        return;
    }
    /**
     * Borrar un enlace
     */
    public function destroy($id)
    {
        $enlace = Enlace::findOrFail($id);
        $enlace -> delete();
    }
}
