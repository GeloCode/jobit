<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Hacemos la relación de que un Role puede tener muchos usuarios .
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
