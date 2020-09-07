<?php

namespace App\Http\Controllers;
use Exception;
use App\ModalidadPrograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProgramaModalidadController extends Controller
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
            "programa" => $request->data["programa"]["id"],
            "modalidad" => $request->data["modalidad"]["id"]
        ];

        $validacion = $this->validaciones($lista);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }
        $programaModalidad = new ModalidadPrograma();

        $programaModalidad->id_programa = $request->data["programa"]["id"];
        $programaModalidad->id_modalidad = $request->data["modalidad"]["id"];

        try {
            $programaModalidad->save();
        } catch (Exception $e) {
            return response()->json(['error' => 'La asignatura ya tiene una línea. Si el criterio es que debe registrarla, verficar en la linea de asignación por asignatura, en la opción eliminar ¡Gracias!.'], 422);
        }
        // $materiaOrigen = Materia::find($request->data["materiaOrigen"]["id"]);
        // $materia = Materia::find($request->data["modalidad"]["id"]);
        // $programaModalidad->materiaOrigen = $materiaOrigen;
        // $programaModalidad->materia = $materia;
        return response()->json(["success" => true, "data" => $programaModalidad->with('programa')->with('modalidad')->first()]);
    }


    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {

            $programaModalidads = ModalidadPrograma::join('programas', 'modalidad_programas.id_programa', 'programas.id')
                ->join(
                    "modalidads",
                    "modalidad_programas.id_modalidad",
                    "modalidads.id"
                )
                ->where('programas.nombre', 'like', '%' . $request->buscar . '%')
                ->select("modalidad_programas.*")
                ->orderBy('programas.id', 'asc')
                ->with('programa')
                ->with('modalidad')
                ->paginate(5);
        } else {
            $programaModalidads = ModalidadPrograma::join('programas', 'modalidad_programas.id_programa', 'programas.id')
            ->join(
                "modalidads",
                "modalidad_programas.id_modalidad",
                "modalidads.id"
            )
                ->select("modalidad_programas.*")
                ->orderBy('programas.id', 'asc')
                ->with('programa')
                ->with('modalidad')
                ->paginate(5);
        }

        return response()->json(["success" => true, "data" => $programaModalidads]);
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
                ModalidadPrograma::where('id_programa', $data["programa"]["id"])->where('id_modalidad', $data["modalidad"]["id"])->delete();
            } catch (\Exception $e) {
                return response()->json(['error' => 'Por favor eliminar los registros asignatura, en la jerarquia es el mas interno.'], 422);
            }
        }
        return response()->json(["success" => true]);
    }

    function validaciones($array)
    {
        $regla   = [
            'programa'    => 'required',
            'modalidad'    => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'unique'   => 'El campo :attribute ya se encuentra registrado.'
        ];

        $validator = Validator::make($array, $regla, $mensaje);
        return  $validator;
    }
}
