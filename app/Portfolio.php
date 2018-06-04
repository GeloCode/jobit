<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    //use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'titulo','text'];
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
