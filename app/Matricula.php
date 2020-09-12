<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id');
    }
    public function estudiante()
    {
        return $this->belongsTo(Usuario::class, 'id_estudiante', 'id');
    }
    public function plan()
    {
        return $this->belongsTo(Plane::class, 'id_plan', 'id');
    }
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id');
    }
    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'id_escuela', 'id');
    }
}
