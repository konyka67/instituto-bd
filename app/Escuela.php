<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{


    public function usuarios(){
        return $this->belongsToMany(Usuario::class,'escuela_usuarios','id_escuela','id_usuario')->withTimestamps();
    }

    public function sede(){
        return $this->belongsTo(Sede::class,'id_sede','id');
    }

}
