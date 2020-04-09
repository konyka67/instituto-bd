<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "nombre",
        "id_pais",
    ];
    /**
     * buscar departamento
     */
    function buscar($dato, $pais)
    {
        $departamento = $this->where('nombre', $dato)->where("id_pais",$pais->id)->first();
        if (!empty($departamento)) {
            return $departamento;
        } else {
            return $this->crear($dato, $pais);
        }
    }
    /**
     * crear departamento
     */
    function crear($dato, $pais)
    {
        $this->nombre = $dato;
        $this->id_pais = $pais->id;
        $this->save();
        return $this;
    }
}
