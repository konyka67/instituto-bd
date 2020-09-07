<?php

namespace App\Http\Controllers;

use App\EscuelaUsuario;
use App\Usuario;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EscuelaUsuarioController extends Controller
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
            && !empty($request->data["usuario"]["id"])
        ) {
            $lista = [
                "id_escuela" => $request->data["escuela"]["id"],
                "id_usuario" => $request->data["usuario"]["id"],
                "id_programa" => $request->data["programa"]["id"]
            ];

            $validacion = $this->validaciones($lista);
            if ($validacion->fails()) {
                return response()->json($validacion->errors(), 422);
            }

            $escuelaUsuario = new EscuelaUsuario();
            $escuelaUsuario->id_escuela = $request->data["escuela"]["id"];
            $escuelaUsuario->id_usuario = $request->data["usuario"]["id"];
            $escuelaUsuario->id_programa = $request->data["programa"]["id"];
            $escuelaUsuario->anio_vigencia_inicial = $request->data["anio_vigencia_inicial"];
            $escuelaUsuario->anio_vigencia_final = $request->data["anio_vigencia_final"];
            try {
                $escuelaUsuario->save();
            } catch (Exception $e) {
                return response()->json(['error' => 'El usuario ya se encuentra registrado en la escuela.'], 422);
            }
            $escuelaUsuario->escuela = $request->data["escuela"];
            $escuelaUsuario->usuario = $request->data["usuario"];
            $escuelaUsuario->programa = $request->data["programa"];

            return response()->json(["success" => true, "data" => $escuelaUsuario]);
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


        $escuelaUsuario = EscuelaUsuario::with('programa')->with('escuela')->with('usuario')
            ->whereHas('usuario', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%")
                ->where("tipo", $request->tipo);
            })
            ->join(
                "usuarios",
                "escuela_usuarios.id_usuario",
                "usuarios.id")
            ->select('escuela_usuarios.*')
            ->orderBy('usuarios.id', 'asc')
            ->paginate(5);

        } else {
            $escuelaUsuario = EscuelaUsuario::with('programa')->with('escuela')->with('usuario')
            ->join(
                "usuarios",
                "escuela_usuarios.id_usuario",
                "usuarios.id")
            ->select('escuela_usuarios.*')
            ->orderBy('usuarios.id', 'asc')
            ->paginate(5);
        }
        return response()->json(["success" => true, "data" => $escuelaUsuario]);
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
            EscuelaUsuario::where('id_escuela', $data["escuela"]["id"])
            ->where('id_usuario', $data["usuario"]["id"])
            ->where('id_programa', $data["programa"]["id"])
            ->delete();
        }
        return response()->json(["success" => true]);
    }

    function validaciones($array)
    {
        $regla   = [
            'id_escuela'    => 'required',
            'id_usuario'    => 'required',
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
