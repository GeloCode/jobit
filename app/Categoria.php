<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * Hacemos la relación de que una categoria le pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
