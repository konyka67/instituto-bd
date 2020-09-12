<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesAulaEstudiante extends Model
{
    //

    public function archivo()    {
        return $this->belongsTo(ArchivosBiblioteca::class,'id_archivo');
    }
}
