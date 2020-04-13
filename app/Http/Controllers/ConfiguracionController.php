<?php

namespace App\Http\Controllers;

use App\Configuracione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ConfiguracionController extends Controller
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


        $configuracion=new Configuracione();

        $configuracionAux=Configuracione::find($request->configuracion["key"]);
        if(!empty($configuracionAux)){
            $configuracion=$configuracionAux;
        }

        $configuracion->key=$request->configuracion["key"];
        if(!empty($request->configuracion["value"])){
           $configuracion->value=$request->configuracion["value"];
        }
        if(!empty($request->configuracion["value_medium"])){
           $configuracion->value=$request->configuracion["value_medium"];
        }
        if(!empty($request->configuracion["value_long"])){
           $configuracion->value=$request->configuracion["value_long"];
        }
        $configuracion->save();
        return response()->json(["success" => true,"configuraciones" => Configuracione::all()]);
    }
     /**
     * getConfiguration a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllConfiguration (Request $request){

        return response()->json(["success" => true,"configuraciones" => Configuracione::all()]);
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
            'key'    => 'required',
        ];
        $mensaje =[
            'required'=>'El campo :attribute es obligatorio'
        ];

        $validator=Validator::make($request->configuracion,$regla,$mensaje);
        return  $validator;

    }
}
