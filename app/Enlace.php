<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $fillable = ['user_id', 'web', 'enlace'];
    /**
     * Hacemos la relación de que un enlace le pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
