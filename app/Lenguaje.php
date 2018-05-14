<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lenguaje extends Model
{
    /**
     * Hacemos la relación de que un lenguaje le pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
