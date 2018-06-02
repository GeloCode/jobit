<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\User;
use App\Perfil;
class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPortfolios()
    {
        return Portfolio::orderBy('id', 'DESC')->get();
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNameUser()
    {
        return User::get();
        // find($id_portfolio)
        /*// find a specific user and see their attributes
            App\User::where('username', 'samuel')->first();
            */

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function getPortfolioById($id){
        return Portfolio::find($id);
    }

    public function getPortfolioByUserId($id){
        return Portfolio::where('user_id', $id)->first();
    }

    public function getInfoPortfolio($id_seleccionado){
        return Portfolio::where('id', $id_seleccionado)->get();
    }
    public function getPortfIdJoint($id_perfil){
       return Portfolio::where('perfil_id', function ($query) use ($id_perfil) {
            $query->select('id')->from('perfils')->where('user_id', '=', $id_perfil);
       })->select('id')->first();
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
            'perfil_id' => 'required',
            'titulo' => 'required',
            'text' => 'required'
        ]);
        Portfolio::create($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio -> delete();
    }
}