<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProgramacionHorario extends Model
{
    //

    /**
 * Get the user's full name.
 *
 * @return string
 */
public function getFechaInicialAttribute($value)
{
    return Carbon::parse($value)->toATOMString();
}

    /**
 * Get the user's full name.
 *
 * @return string
 */
public function getFechaFinalAttribute($value)
{
    return Carbon::parse($value)->toATOMString();
}

    public function getHoraInicialAttribute($value)
    {
        $time = Carbon::createFromFormat('H:i:s', $value);

        return $time->format('H:i a');
    }

    public function getHoraFinalAttribute($value)
    {
        $time = Carbon::createFromFormat('H:i:s', $value);

        return $time->format('H:i a');
    }

    public function asigProfeAsig(){
        return $this->belongsTo(AsigProfeAsig::class,'id_asig_profe','id');
    }

    public function archivoBiblioteca(){
        return $this->belongsTo(ArchivosBiblioteca::class,'id_asig_profe','id');
    }

    public function estudiantes(){
        return $this->belongsToMany(Usuario::class,'inscripcion_asig_es','id_programacion','id_estudiante')->withTimestamps();
    }
}
