<?php

namespace App\Http\Controllers;

use App\EscuelaPrograma;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class EscuelaProgramaController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
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

        if (
            !empty($request->data["escuela"]["id"])
            && !empty($request->data["programa"]["id"])
        ) {
            $lista = [
                "id_escuela" => $request->data["escuela"]["id"],
                "id_programa" => $request->data["programa"]["id"]
            ];

            $validacion = $this->validaciones($lista);
            if ($validacion->fails()) {
                return response()->json($validacion->errors(), 422);
            }
            $escuelaPrograma = new EscuelaPrograma();
            if (!empty($request->data["programa"]["id"])
            || !empty($request->data["escuela"]["id"])) {
                $escuelaProgramaNuevo = EscuelaPrograma::where("id_programa", $request->data["programa"]["id"])
                    ->where("id_escuela", $request->data["escuela"]["id"])
                    ->first();
                if (!empty($escuelaProgramaNuevo) && !is_null($escuelaProgramaNuevo)) {
                    $escuelaPrograma = $escuelaProgramaNuevo;
                }
            }
            $escuelaPrograma->id_escuela = $request->data["escuela"]["id"];
            $escuelaPrograma->id_programa = $request->data["programa"]["id"];
            $escuelaPrograma->anio_vigencia_inicial = $request->data["anio_vigencia_inicial"];
            $escuelaPrograma->anio_vigencia_final = $request->data["anio_vigencia_final"];
            try {
                $escuelaPrograma->save();
            } catch (Exception $e) {
                return response()->json(['error' => 'El programa ya se encuentra registrado en la escuela.'], 422);
            }

            $escuelaPrograma->escuela = $request->data["escuela"];
            $escuelaPrograma->programa = $request->data["programa"];
            $escuelaPrograma->compoundKey = "".$escuelaPrograma->id_programa.','.$escuelaPrograma->id_escuela."";
            return response()->json(["success" => true, "data" => $escuelaPrograma]);
        }
        return response()->json(["success" => false]);
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
    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {


        $escuelaPrograma = EscuelaPrograma::with('programa')->with('escuela')->with('usuario')
            ->whereHas('escuela', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })
            ->join(
                "escuelas",
                "escuela_programas.id_escuela",
                "escuelas.id")
            ->select('escuela_programas.*',DB::raw("concat(id_programa,',',id_escuela) as compoundKey"))
            ->orderBy('escuelas.id', 'asc')
            ->paginate(5);

        } else {
            $escuelaPrograma = EscuelaPrograma::with('programa')->with('escuela')
            ->join(
                "escuelas",
                "escuela_programas.id_escuela",
                "escuelas.id")
            ->select('escuela_programas.*',DB::raw("concat(id_programa,',',id_escuela) as compoundKey"))
            ->orderBy('escuelas.id', 'asc')
            ->paginate(5);
        }
        return response()->json(["success" => true, "data" => $escuelaPrograma]);
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
            EscuelaPrograma::where('id_escuela', $data["escuela"]["id"])
            ->where('id_programa', $data["programa"]["id"])
            ->delete();
        }
        return response()->json(["success" => true]);
    }

    function validaciones($array)
    {
        $regla   = [
            'id_escuela'    => 'required',
            'id_programa'    => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'unique'   => 'El campo :attribute ya se encuentra registrado.'
        ];

        $validator = Validator::make($array, $regla, $mensaje);
        return  $validator;
    }
}
