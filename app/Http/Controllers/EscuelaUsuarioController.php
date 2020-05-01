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
            !empty($request->escuela_usuario["escuela"]["id"])
            && !empty($request->escuela_usuario["usuario"]["id"])
        ) {
            $lista = [
                "id_escuela" => $request->escuela_usuario["escuela"]["id"],
                "id_usuario" => $request->escuela_usuario["usuario"]["id"]
            ];

            $validacion = $this->validaciones($lista);
            if ($validacion->fails()) {
                return response()->json($validacion->errors(), 422);
            }

            $escuelaUsuario = new EscuelaUsuario();
            $escuelaUsuario->id_escuela = $request->escuela_usuario["escuela"]["id"];
            $escuelaUsuario->id_usuario = $request->escuela_usuario["usuario"]["id"];
            try {
                $escuelaUsuario->save();
            } catch (Exception $e) {
                return response()->json(['error' => 'El usuario ya se encuentra registrado en la escuela.'], 422);
            }
            $escuelaUsuario->escuela = $request->escuela_usuario["escuela"];
            $escuelaUsuario->usuario = $request->escuela_usuario["usuario"];
            return response()->json(["success" => true, "escuela-usuario" => $escuelaUsuario]);
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
        if( !empty($request->buscar) && $request->buscar !== 'undefined'){
            $usuariosPagination = Usuario::join(
                "escuela_usuarios",
                "usuarios.id",
                "escuela_usuarios.id_usuario"
            )->join(
                "escuelas",
                "escuela_usuarios.id_escuela",
                "escuelas.id"
            )
                ->where("usuarios.tipo", $request->tipo)
                ->where("usuarios.nombre", "like", "%" . $request->buscar . "%")
                ->orderBy('usuarios.id', 'asc')
                ->select(
                    'usuarios.*',
                    'escuela_usuarios.id_escuela',
                    'escuelas.nombre as nombre_e',
                    'escuelas.id_sede',
                    'escuelas.created_at as created_at_e',
                    'escuelas.updated_at as updated_at_e',
                    'escuela_usuarios.created_at as created_at_eu',
                    'escuela_usuarios.updated_at as updated_at_eu'
                )
                ->paginate(5);

            return response()->json(["success" => true, "escuela-usuario" => $usuariosPagination]);
        } else {
            $usuariosPagination = Usuario::join(
                "escuela_usuarios",
                "usuarios.id",
                "escuela_usuarios.id_usuario"
            )->join(
                "escuelas",
                "escuela_usuarios.id_escuela",
                "escuelas.id"
            )
                ->where("usuarios.tipo", $request->tipo)
                ->orderBy('usuarios.id', 'asc')
                ->select(
                    'usuarios.*',
                    'escuela_usuarios.id_escuela',
                    'escuelas.nombre as nombre_e',
                    'escuelas.id_sede',
                    'escuelas.created_at as created_at_e',
                    'escuelas.updated_at as updated_at_e',
                    'escuela_usuarios.created_at as created_at_eu',
                    'escuela_usuarios.updated_at as updated_at_eu'
                )->paginate(5);

            return response()->json(["success" => true, "escuela-usuario" => $usuariosPagination]);
        }
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
        foreach ($request["escuela-usuario"] as $escuela_usuario) {
            EscuelaUsuario::where('id_escuela', $escuela_usuario["escuela"]["id"])->where('id_usuario', $escuela_usuario["usuario"]["id"])->delete();
        }
        return response()->json(["success" => true]);
    }

    function validaciones($array)
    {
        $regla   = [
            'id_escuela'    => 'required',
            'id_usuario'    => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio',
            'unique'   => 'El campo :attribute ya se encuentra registrado.'
        ];

        $validator = Validator::make($array, $regla, $mensaje);
        return  $validator;
    }
}
