<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    public function programas(){
        return $this->belongsToMany(Programa::class,'modalidad_programas','id_modalidad','id_programa')->withTimestamps();
    }
}
