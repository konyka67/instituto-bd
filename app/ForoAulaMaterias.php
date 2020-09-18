<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForoAulaMaterias extends Model
{
    public function asigProfeAsig(){
        return $this->belongsTo(AsigProfeAsig::class,'id_asig_profe_asigs','id');
    }

    public function profesor(){
        return $this->belongsTo(Usuario::class,'id_profesor','id');
    }
}
