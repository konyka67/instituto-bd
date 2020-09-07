<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedias extends Model
{



    public function noticias(){
        return $this->belongsToMany(Noticia::class,'multimedia_noticias','id_multimedia','id_noticia')->withTimestamps();
    }
}
