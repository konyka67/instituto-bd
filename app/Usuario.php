<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Añadimos la clase JWTSubject
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "nombre_uno",
        "nombre_dos",
        "email",
        "password",
        "apellido_uno",
        "apellido_dos",
        "tipo",
        "cedula",
        "telefono",
        "celular",
        "foto",
        "sex"
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        Añadiremos estos dos métodos
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function localizacion()    {
        return $this->belongsTo(Localizacion::class,'id_localizacion','id');
    }

    public function escuelas(){
        return $this->belongsToMany(Escuela::class,'escuela_usuarios','id_usuario','id_escuela')->withTimestamps();
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'rol_usuarios','id_usuario','id_rol')->withTimestamps();
    }
}
