<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriasLinea extends Model
{
    public function materiaOrigen(){
        return $this->belongsTo(Materia::class,'id_materia_origen','id');
    }

    public function materia(){
        return $this->belongsTo(Materia::class,'id_materia','id');
    }
}
