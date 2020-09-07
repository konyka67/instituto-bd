<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscuelaUsuario extends Model
{

    public function escuela(){
        return $this->belongsTo(Escuela::class,'id_escuela','id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }

    public function programa(){
        return $this->belongsTo(Programa::class,'id_programa','id');
    }
}
