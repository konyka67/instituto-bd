<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultimediaNoticias extends Model
{
    public function noticia(){
        return $this->belongsTo(Noticia::class,'id_noticia','id');
    }

    public function multimedia(){
        return $this->belongsTo(Multimedias::class,'id_multimedia','id');
    }
}
