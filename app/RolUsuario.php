<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{

    public function rol(){
        return $this->belongsTo(Role::class,'id_rol','id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }
}
