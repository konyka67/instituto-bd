<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Escuela;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EscuelaController extends Controller
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
        $validacion = $this->validaciones($request);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }
        $escuela = new Escuela();
        if (!empty($request->escuela["id"])) {
            $escuela = Escuela::find($request->escuela["id"]);
        }
        $escuela->nombre = $request->escuela["nombre"];
        //PARA BUSCAR O GURDAR LA LOCALIZACION
        if (!empty($request->escuela["sede"])) {
            $escuela->id_sede = $request->escuela["sede"]["id"];
        }
        $escuela->save();
        $escuela->sede = $request->escuela["sede"];
        return response()->json(["success" => true, "escuela" => $escuela]);
    }

    function validaciones(Request $request)
    {
        $regla   = [
            'nombre'    => 'required',
            'sede'  => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio'
        ];

        $validator = Validator::make($request->escuela, $regla, $mensaje);
        return  $validator;
    }

    public function getPagination(Request $request)
    {

        if (!empty($request->buscar)) {
            $escuelasPagination = Sede::join("escuelas", "sedes.id", "escuelas.id_sede")
                ->where("escuelas.nombre", "like", "%" . $request->buscar . "%")
                ->orderBy('escuelas.id', 'asc')
                ->select(
                    'escuelas.*',
                    'sedes.nombre as nombre_s',
                    'sedes.created_at as created_at_s',
                    'sedes.updated_at as updated_at_s',
                    'sedes.id_localizacion'
                )
                ->paginate(5);
        } else {
            $escuelasPagination = Sede::join("escuelas", "sedes.id", "escuelas.id_sede")
                ->orderBy('escuelas.id', 'asc')
                ->select(
                    'escuelas.*',
                    'sedes.nombre as nombre_s',
                    'sedes.created_at as created_at_s',
                    'sedes.updated_at as updated_at_s',
                    'sedes.id_localizacion'
                )
                ->paginate(5);
        }
        return response()->json(["escuela" => $escuelasPagination]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->escuelas as $escuela) {
            array_push($arraIn, $escuela["id"]);
        }
        Escuela::whereIn('id', $arraIn)->delete();
        return response()->json(["success" => true]);
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

    public function get(Request $request)
    {
        $escuela = Sede::join("escuelas", "sedes.id", "esceulas.id_sede")
            ->select(
                'escuelas.*',
                'sedes.nombre',
                'sedes.created_at_s',
                'sedes.updated_at_s',
                'sedes.id_localizacion'
            )->firts();

        return response()->json(["success" => true, "escuela" => $escuela]);
    }
}
