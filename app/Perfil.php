<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /**
     * Campos que podremos modificar/inserta el usuario
     */
    protected $fillable = [
        'user_id', 'portfolio_id', 'provincia_id', 'name', 'telefono', 'direccion', 'codigo_postal', 'lenguajes',
        'frameworks', 'descripcion', 'imagen'
    ];

    /**
     * Hacemos la relación de que un user le pertenece a un perfil .
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * Hacemos la relación de que un portfolio le pertenece a un perfil .
     */
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class, 'id');
    }
}
