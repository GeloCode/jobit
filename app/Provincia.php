<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    /**
     * Hacemos la relación de que una provincia tiene muchos perfiles.
     */
    public function perfiles()
    {
        return $this->hasMany(Perfil::class);
    }

    /**
     * Hacemos la relación de una provincia le pertenece a una oferta.
     */
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }
}
