<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    /**
     * Campos que podremos modificar/inserta el usuario
     */
    protected $fillable = [
        'user_id', 'oferta_id', 'estado'
    ];

    /**
     * Hacemos la relación de que una inscripcion le pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hacemos la relación de que una inscripcion le pertenece a una oferta.
     */
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

}
