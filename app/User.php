<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Campos que podremos modificar/inserta el usuario
     */
    protected $fillable = [
        'name', 'email', 'password', 'telefono', 'direccion', 'codigo_postal', 'rango_desde', 'rango_hasta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Hacemos la relación de que un role le pertenece a muchos usuarios .
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id');
    }

    /**
     * Hacemos la relación de que una provincia le pertenece a muchos usuarios .
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    /**
     * Hacemos la relación de que un usuario puede tener muchas ofertas con el rol de Empresa .
     */
    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    /**
     * Hacemos la relación de que un usuario puede tener muchas inscripciones con el rol de Solicitante .
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    /**
     * Hacemos la relación de que un usuario puede tener muchos proyectos con el rol de Solicitante .
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
    
    /**
     * Hacemos la relación de que un usuario puede tener muchos portfolios con el rol de Solicitante .
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
