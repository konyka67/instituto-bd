<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProHorarioEstudiante extends Model
{
    public function programacionHorario(){
        return $this->belongsTo(ProgramacionHorario::class,'id_programacion','id');
    }

    public function estudiante(){
        return $this->belongsTo(Usuario::class,'id_estudiante','id');
    }
}
