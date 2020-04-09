<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{

    protected $table = 'pais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "nombre",
    ];
    /**
     * buscar pais
     */
    function buscar($dato)
    {
        $pais = $this->where('nombre', $dato)->first();

        if (!empty($pais)) {
            return $pais;
        } else {
            return $this->crear($dato);
        }
    }
    /**
     * crear pais
     */
    function crear($dato)
    {
        $this->nombre = $dato;
        $this->save();
        return $this;
    }
}
