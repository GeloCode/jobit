<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre','descripcion','condicion'];
    public $timestamps = false;
    /**
     * Hacemos la relación de que un Role puede tener muchos usuarios .
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
