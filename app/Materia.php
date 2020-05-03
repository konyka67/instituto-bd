<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{



    public function materiasOrigen(){
        return $this->belongsToMany(Materia::class,'materias_lineas','id_materia','id_materia_origen');
    }

    public function materias(){
        return $this->belongsToMany(Materia::class,'materias_lineas','id_materia_origen','id_materia');
    }
}
