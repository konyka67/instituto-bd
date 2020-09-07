<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionAsigEs extends Model
{
    public function programacion(){
        return $this->belongsTo(ProgramacionHorario::class,'id_programacion','id');
    }

    public function estudiante(){
        return $this->belongsTo(Usuario::class,'id_estudiante','id');
    }
}
