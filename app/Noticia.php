<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{


    public function multimedias(){
        return $this->belongsToMany(Multimedias::class,'multimedia_noticias','id_noticia','id_multimedia')->withTimestamps();
    }
}
