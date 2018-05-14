<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    /**
     * Hacemos la relación de que una oferta tiene muchas inscripciones.
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    /**
     * Hacemos la relación de que muchas ofertas  le pertenecen a un usuario con el rol "Empresa" .
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hacemos la relación de que una provincia tiene muchas ofertas .
     */
    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }
}
