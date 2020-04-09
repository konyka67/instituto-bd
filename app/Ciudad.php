<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "nombre",
        "id_departamento",
    ];
    /**
     * buscar ciudad
     */
    function buscar($dato, $departamento)
    {
        $ciudad = $this->where('nombre', $dato)->where("id_departamento",$departamento->id)->first();
        if (!empty($ciudad)) {
            return $ciudad;
        } else {
            return $this->crear($dato, $departamento);
        }
    }
    /**
     * crear ciudad
     */
    function crear($dato, $departamento)
    {
        $this->nombre = $dato;
        $this->id_departamento = $departamento->id;
        $this->save();
        return $this;
    }
}
