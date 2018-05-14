<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    /**
     * Hacemos la relación de que una provincia tiene muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Hacemos la relación de una provincia tiene muchas ofertas.
     */
    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }
}
