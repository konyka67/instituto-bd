<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public function modalidades(){
        return $this->belongsToMany(Modalidad::class,'modalidad_programas','id_programa','id_modalidad')->withTimestamps();
    }

    public function nivelAcademico(){
        return $this->belongsTo(NivelAcademico::class,'id_nivel','id');
    }
}
