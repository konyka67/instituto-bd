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
        if (!empty($request->data["id"])) {
            $escuela = Escuela::find($request->data["id"]);
        }
        $escuela->nombre = $request->data["nombre"];
        //PARA BUSCAR O GURDAR LA LOCALIZACION
        if (!empty($request->data["sede"])) {
            $escuela->id_sede = $request->data["sede"]["id"];
        }
        $escuela->save();
        // $escuela->sede = $request->data["sede"];
        return response()->json(["success" => true, "data" => $escuela->with('sede')->first()]);
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

        $validator = Validator::make($request->data, $regla, $mensaje);
        return  $validator;
    }

    public function getPagination(Request $request)
    {

        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $escuelasPagination = Escuela::join(
                "sedes",
                "escuelas.id_sede",
                "sedes.id"
            )
                ->where("escuelas.nombre", "like", "%" . $request->buscar . "%")
                ->orderBy('escuelas.id', 'asc')
                ->select(
                    'escuelas.*',
                )->with('sede')
                ->paginate(5);
        } else {
            $escuelasPagination = Escuela::join(
                "sedes",
                "escuelas.id_sede",
                "sedes.id"

            )->orderBy('escuelas.id', 'asc')
                ->select(
                    'escuelas.*',
                )->with('sede')
                ->paginate(5);
        }
        return response()->json(["data" => $escuelasPagination]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Escuela::whereIn('id', $arraIn)->delete();
        $this->refreshDB('escuelas');
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
        $escuela = Sede::join(
            "escuelas",
            "sedes.id",
            "esceulas.id_sede"
        )->select(
            'escuelas.*',
            'sedes.nombre',
            'sedes.created_at_s',
            'sedes.updated_at_s',
            'sedes.id_localizacion'
        )->firts();

        return response()->json(["success" => true, "data" => $escuela]);
    }
}
