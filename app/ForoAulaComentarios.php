<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForoAulaComentarios extends Model
{
    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }

    public function comentarioHijo(){
        return $this->hasMany(ForoAulaComentarios::class,'id_jerarquia_comentario','id');
    }
    public function comentarioPadre(){
        return $this->belongsTo(ForoAulaComentarios::class,'id_jerarquia_comentario','id');
    }
    public function foro(){
        return $this->belongsTo(ForoAulaMaterias::class,'id_foro','id');
    }

}
