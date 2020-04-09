<?php

namespace App;

use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class Direccion
{

    private $direccion;
    private $ciudad;
    private $departamento;
    private $pais;
    private $array;
    /**
     *
     */
    public function __construct($cadena)
    {
        $this->array = explode(',', $cadena);
    }

    public function ver()
    {
        foreach ($this->array as &$valor) {
            Log::info($valor);
        }
    }

    public function arrayValue($numero)
    {
        return $this->array[$numero];
    }

    public function ejecutar()
    {
        $size = count($this->array);
        switch ($size) {
            case  2:
                $this->direccion =mb_strtoupper(trim($this->array[0]));
                $this->ciudad =mb_strtoupper(trim($this->array[1]));
                $this->departamento =mb_strtoupper(trim($this->array[1]));
                $this->pais =mb_strtoupper(trim($this->array[1]));
                break;
            case  3:
                $this->direccion =mb_strtoupper(trim($this->array[0]));
                $this->ciudad =mb_strtoupper(trim($this->array[1]));
                $this->departamento =mb_strtoupper(trim($this->array[1]));
                $this->pais =mb_strtoupper(trim($this->array[2]));
                break;
            case  4:
                $this->direccion =mb_strtoupper(trim($this->array[0]));
                $this->ciudad =mb_strtoupper(trim($this->array[1]));
                $this->departamento =mb_strtoupper(trim($this->array[2]));
                $this->pais =mb_strtoupper(trim($this->array[3]));
                break;
        }
    }

    function isEmpty(){
        return empty($this->direccion) && empty($this->ciudad) && empty($this->departamento) && empty($this->pais);
    }

    function getDireccion()
    {
        return $this->direccion;
    }

    function getCiudad()
    {
        return $this->ciudad;
    }

    function getDepartamento()
    {
        return $this->departamento;
    }

    function getPais()
    {
        return $this->pais;
    }
}
