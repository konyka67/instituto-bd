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
            "asignatura_origen" => $request->data["materia_origen"]["id"],
            "asignatura" => $request->data["materia"]["id"]
        ];

        $validacion = $this->validaciones($lista);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }
        $lineaMateria = new MateriasLinea();

        $lineaMateria->id_materia_origen = $request->data["materia_origen"]["id"];
        $lineaMateria->id_materia = $request->data["materia"]["id"];

        try {
            $lineaMateria->save();
        } catch (Exception $e) {
            return response()->json(['error' => 'La asignatura ya tiene una línea. Si el criterio es que debe registrarla, verficar en la linea de asignación por asignatura, en la opción eliminar ¡Gracias!.'], 422);
        }
        // $materiaOrigen = Materia::find($request->data["materiaOrigen"]["id"]);
        // $materia = Materia::find($request->data["materia"]["id"]);
        // $lineaMateria->materiaOrigen = $materiaOrigen;
        // $lineaMateria->materia = $materia;
        return response()->json(["success" => true, "data" => $lineaMateria->with('materia')->with('materiaOrigen')->first()]);
    }


    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {

            $lineaMaterias = MateriasLinea::join('materias', 'materias_lineas.id_materia_origen', 'materias.id')
                ->join(
                    "materias as materias_m",
                    "materias_lineas.id_materia",
                    "materias_m.id"
                )
                ->where('materias.nombre', 'like', '%' . $request->buscar . '%')
                ->select("materias_lineas.*")
                ->orderBy('materias.id', 'asc')
                ->with('materiaOrigen')
                ->with('materia')
                ->paginate(5);
        } else {
            $lineaMaterias = MateriasLinea::join('materias', 'materias_lineas.id_materia_origen', 'materias.id')
                ->join(
                    "materias as materias_m",
                    "materias_lineas.id_materia",
                    "materias_m.id"
                )
                ->select("materias_lineas.*")
                ->orderBy('materias.id', 'asc')
                ->with('materiaOrigen')
                ->with('materia')
                ->paginate(5);
        }

        return response()->json(["success" => true, "data" => $lineaMaterias]);
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
        foreach ($request["datas"] as $data) {
            try {
                MateriasLinea::where('id_materiaOrigen', $data["materia_rigen"]["id"])->where('id_materia', $data["materia"]["id"])->delete();
            } catch (\Exception $e) {
                return response()->json(['error' => 'Por favor eliminar los registros asignatura, en la jerarquia es el mas interno.'], 422);
            }
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
