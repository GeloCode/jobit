<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    /**
     * Hacemos la relación de que muchas ofertas  le pertenecen a un usuario con el rol "Empresa" .
     */
    protected $fillable = ['user_id', 'portfolio_id', 'titulo', 'descripcion', 'imagen'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hacemos la relación de que muchos proyectos  le pertenecen a un portfolio .
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
