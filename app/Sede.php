<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{

    public function escuelas()    {
        return $this->hasMany(Escuela::class,'id_sede');
    }

    public function localizacion(){
        return $this->belongsTo(Localizacion::class,'id_localizacion');
    }
}
