<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    /**
     * Hacemos la relación de que un portfolio le pertenece a un usuario con el rol de "solicitante".
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hacemos la relación de que un portfolio tiene muchos proyectos.
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}
