<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivosBiblioteca extends Model
{
    //


    public function salon(){
        return $this->belongsTo(Salon::class,'id_salon','id');
    }

    public function programacionHorario(){
        return $this->belongsTo(ProgramacionHorario::class,'id_programacion_horario','id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }

    public function integrantes(){
        return $this->belongsToMany(Usuario::class,'ppt_integrantes','id_archivo','id_usuario');
    }

}
