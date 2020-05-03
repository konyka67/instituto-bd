<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function usuarios(){
        return $this->belongsToMany(Usuario::class,'rol_usuarios','id_rol','id_usuario')->withTimestamps();
    }
}
