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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
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
        $validacion=$this->validaciones($request);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }
        $sede =new Sede();
        $sede->nombre=$request->sede["nombre"];
        //PARA BUSCAR O GURDAR LA LOCALIZACION
        if (!empty($request->sede["localizacion"])) {
            $direccion = new Direccion($request->sede["localizacion"]["direccion"]);
            $direccion->ejecutar();
            if(!$direccion->isEmpty()){
                $pais = new Pais();
                $departamento = new Departamento();
                $ciudad = new Ciudad();
                $pais = $pais->buscar($direccion->getPais());
                $departamento = $departamento->buscar($direccion->getDepartamento(),$pais);
                $ciudad = $ciudad->buscar($direccion->getCiudad(),$departamento);
                $localizacionTable = new Localizacion();
                $localizacionTable = $localizacionTable->buscar($request->sede["localizacion"]["latitud"],$request->sede["localizacion"]["longitud"],$direccion->getDireccion(),$ciudad);
                $sede->id_localizacion = $localizacionTable->id;
                $sede->save();
                return response()->json(["success" => true]);
            }
        }
        return response()->json(["success" => false]);
    }

    public function getPagination(Request $request){

        if(!empty($request->buscar)){
        $sedesPagination=Localizacion::join("sedes","localizacions.id","sedes.id_localizacion")
                             ->where("nombre","like","%".$request->buscar."%")
                             ->select('sedes.id',
                               'sedes.nombre',
                               'sedes.created_at',
                               'sedes.updated_at',
                               'sedes.id_localizacion',
                               'localizacions.direccion',
                               'localizacions.latitud',
                               'localizacions.longitud',
                               'localizacions.id_ciudad',
                               'localizacions.created_at as created_at_l',
                               'localizacions.updated_at as updated_at_l')
                             ->paginate(5);
        }else{
           $sedesPagination=Localizacion::join("sedes","localizacions.id","sedes.id_localizacion")
                        ->select('sedes.id',
                        'sedes.nombre',
                        'sedes.created_at',
                        'sedes.updated_at',
                        'sedes.id_localizacion',
                        'localizacions.direccion',
                        'localizacions.latitud',
                        'localizacions.longitud',
                        'localizacions.id_ciudad',
                        'localizacions.created_at as created_at_l',
                        'localizacions.updated_at as updated_at_l')
                        ->paginate(5);
        }
        return response()->json(["sede" => $sedesPagination]);
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

    function validaciones(Request $request){
        $regla   =[
            'nombre'    => 'required',
            'localizacion'  => 'required'
        ];
        $mensaje =[
            'required'=>'El campo :attribute es obligatorio'
        ];

        $validator=Validator::make($request->sede,$regla,$mensaje);
        return  $validator;

    }
}
