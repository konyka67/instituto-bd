<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Departamento;
use App\Direccion;
use App\Localizacion;
use App\Pais;
use App\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SedeController extends Controller
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
        $sede = new Sede();
        if (!empty($request->data["id"])) {
            $sede = Sede::find($request->data["id"]);
        }
        $sede->nombre = $request->data["nombre"];
        //PARA BUSCAR O GURDAR LA LOCALIZACION
        if (!empty($request->data["localizacion"])) {
            $direccion = new Direccion($request->data["localizacion"]["direccion"]);
            $direccion->ejecutar();
            if (!$direccion->isEmpty()) {
                $pais = new Pais();
                $departamento = new Departamento();
                $ciudad = new Ciudad();
                $pais = $pais->buscar($direccion->getPais());
                $departamento = $departamento->buscar($direccion->getDepartamento(), $pais);
                $ciudad = $ciudad->buscar($direccion->getCiudad(), $departamento);
                $localizacionTable = new Localizacion();
                $localizacionTable = $localizacionTable->buscar($request->data["localizacion"]["latitud"], $request->data["localizacion"]["longitud"], $direccion->getDireccion(), $ciudad);
                $sede->id_localizacion = $localizacionTable->id;
                $sede->save();
                $sede->localizacion = $localizacionTable;
                return response()->json(["success" => true, "data" => $sede]);
            }
        }
        return response()->json(["success" => false, "data" => $sede]);
    }

    public function getPagination(Request $request)
    {

        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $sedesPagination = Sede::join(
                "localizacions",
                "sedes.id_localizacion",
                "localizacions.id"
            )
                ->where("sedes.nombre", "like", "%" . $request->buscar . "%")
                ->orderBy('sedes.id', 'asc')
                ->select('sedes.*')
                ->with('localizacion')
                ->paginate(5);
        } else {
            $sedesPagination = Sede::join(
                "localizacions",
                "sedes.id_localizacion",
                "localizacions.id"
            )
                ->orderBy('sedes.id', 'asc')
                ->select('sedes.*')
                ->with('localizacion')
                ->paginate(5);
        }
        return response()->json(["data" => $sedesPagination]);
    }


    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Sede::whereIn('id', $arraIn)->delete();
        $this->refreshDB('sedes');
        return response()->json(["success" => true]);
    }

    public function get(Request $request)
    {

        return response()->json(["success" => true, "sede" => Sede::find($request->id)]);
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

    function validaciones(Request $request)
    {
        $regla   = [
            'nombre'    => 'required',
            'localizacion'  => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio'
        ];

        $validator = Validator::make($request->data, $regla, $mensaje);
        return  $validator;
    }
}
