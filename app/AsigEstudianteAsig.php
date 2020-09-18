<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsigEstudianteAsig extends Model
{
    public function programa(){
        return $this->belongsTo(Programa::class,'id_programa','id');
    }
    public function estudiante(){
        return $this->belongsTo(Usuario::class,'id_estudiante','id');
    }
    public function profesor(){
        return $this->belongsTo(Usuario::class,'id_profesor','id');
    }
    public function salon(){
        return $this->belongsTo(Salon::class,'id_salon','id');
    }
    public function plan(){
        return $this->belongsTo(Plane::class,'id_plan','id');
    }
    public function materia(){
        return $this->belongsTo(Materia::class,'id_materia','id');
    }
}
