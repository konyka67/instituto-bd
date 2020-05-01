<?php

namespace App\Http\Controllers;

use Exception;
use App\Materia;
use App\MateriasLinea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class LineMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lista = [
            "asignatura_origen" => $request->linea_asginatura["materia_origen"]["id"],
            "asignatura" => $request->linea_asginatura["materia"]["id"]
        ];

        $validacion = $this->validaciones($lista);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }
        $lineaMateria = new MateriasLinea();

        $lineaMateria->id_materia_origen = $request->linea_asginatura["materia_origen"]["id"];
        $lineaMateria->id_materia = $request->linea_asginatura["materia"]["id"];

        try {
            $lineaMateria->save();
        } catch (Exception $e) {
            return response()->json(['error' => 'La asignatura ya tiene una línea. Si el criterio es que debe registrarla, verficar en la linea de asignación por asignatura, en la opción eliminar ¡Gracias!.'], 422);
        }
        $materia_origen = Materia::find($request->linea_asginatura["materia_origen"]["id"]);
        $materia = Materia::find($request->linea_asginatura["materia"]["id"]);
        $lineaMateria->materia_origen = $materia_origen;
        $lineaMateria->materia = $materia;
        return response()->json(["success" => true, "linea-asignatura" => $lineaMateria]);
    }


    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $lineaMaterias = Materia::join(
                "materias_lineas",
                "materias.id",
                "materias_lineas.id_materia_origen"
            )->join(
                "materias as materias_m",
                "materias_lineas.id_materia",
                "materias_m.id"
            )
                ->where("materias.nombre", "like", "%" . $request->buscar . "%")
                ->orderBy('materias.id', 'asc')
                ->select(
                    'materias_lineas.*',
                    'materias.id as id_o',
                    'materias.nombre as nombre_o',
                    'materias.credito as credito_o',
                    'materias.created_at as created_at_o',
                    'materias.updated_at as updated_at_o',
                    'materias_m.id as id_m',
                    'materias_m.nombre as nombre_m',
                    'materias_m.credito as credito_m',
                    'materias_m.created_at as created_at_m',
                    'materias_m.updated_at as updated_at_m',
                )
                ->paginate(5);

            return response()->json(["success" => true, "linea-asignatura" => $lineaMaterias]);
        } else {
            $lineaMaterias = Materia::join(
                "materias_lineas",
                "materias.id",
                "materias_lineas.id_materia_origen"
            )->join(
                "materias as materias_m",
                "materias_lineas.id_materia",
                "materias_m.id"
            )
                ->orderBy('materias.id', 'asc')
                ->select(
                    'materias_lineas.*',
                    'materias.id as id_o',
                    'materias.nombre as nombre_o',
                    'materias.credito as credito_o',
                    'materias.created_at as created_at_o',
                    'materias.updated_at as updated_at_o',
                    'materias_m.id as id_m',
                    'materias_m.nombre as nombre_m',
                    'materias_m.credito as credito_m',
                    'materias_m.created_at as created_at_m',
                    'materias_m.updated_at as updated_at_m',
                )
                ->paginate(5);

            return response()->json(["success" => true, "linea-asignatura" => $lineaMaterias]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        foreach ($request["linea-asignatura"] as $linea_asignatura) {
            MateriasLinea::where('id_materia_origen', $linea_asignatura["materia_origen"]["id"])->where('id_materia', $linea_asignatura["materia"]["id"])->delete();
        }

        return response()->json(["success" => true]);
    }

    function validaciones($array)
    {
        $regla   = [
            'asignatura_origen'    => 'required',
            'asignatura'    => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'unique'   => 'El campo :attribute ya se encuentra registrado.'
        ];

        $validator = Validator::make($array, $regla, $mensaje);
        return  $validator;
    }
}
