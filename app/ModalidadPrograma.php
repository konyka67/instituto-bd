<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModalidadPrograma extends Model
{
    public function modalidad(){
        return $this->belongsTo(Modalidad::class,'id_modalidad','id');
    }

    public function programa(){
        return $this->belongsTo(Programa::class,'id_programa','id');
    }


}
