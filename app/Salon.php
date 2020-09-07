<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{

    public function sede(){
        return $this->belongsTo(Sede::class,'id_sede','id');
    }
}
