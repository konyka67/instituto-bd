<?php

namespace App\Http\Controllers;

use App\ForoAulaMaterias;
use Illuminate\Http\Request;

class ForoAulaMateriaController extends Controller
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
        $foro = new ForoAulaMaterias();
        if (!empty($request["data"]["id"])) {
            $foro = $foro::find($request["data"]["id"]);
        }
        $foro->id_profesor = $request["data"]["profesor"]["id"];
        $foro->id_asig_profe_asigs = $request["data"]["asig_profe_asig"]["id"];
        $foro->titulo = $request["data"]["titulo"];
        $foro->descripcion = $request["data"]["descripcion"];
        $foro->save();
        return response()->json(["success" => true, "data" => $foro->with("asigProfeAsig")->with("asigProfeAsig.materia")->with("profesor")->find($foro->id)]);
    }

    /**
     *
     */
    public function getPagination(Request $request)
    {
        $data = json_decode($request->data);
        if($data->data->rol->tipo === 'PR'){
            if (!empty($data->buscar) && $data->buscar !== 'undefined') {
                $foro = ForoAulaMaterias::with("asigProfeAsig")->with("asigProfeAsig.materia")->with("profesor")
                    ->whereHas('asigProfeAsig', function ($query) use ($data) {
                        $query->where('nombre', $data->buscar);
                    })->whereHas('profesor', function ($query) use ($data) {
                        $query->where('id', $data->data->id);
                    })->paginate(5);
            } else {
                $foro = ForoAulaMaterias::with("asigProfeAsig")->with("asigProfeAsig.materia")->with("profesor")
                    ->whereHas('profesor', function ($query) use ($data) {
                        $query->where('id', $data->data->id);
                    })->paginate(5);
            }
        }else{
            if($data->data->rol->tipo === 'ES'){
                $foro = ForoAulaMaterias::with("asigProfeAsig")->with("asigProfeAsig.materia")->with("profesor")->join('asig_profe_asigs','foro_aula_materias.id_asig_profe_asigs','asig_profe_asigs.id')
                ->join('asig_estudiante_asigs',function($join){
                    $join->on('asig_profe_asigs.id_programa','=','asig_estudiante_asigs.id_programa')
                    ->on('asig_profe_asigs.id_profesor','=','asig_estudiante_asigs.id_profesor')
                    ->on('asig_profe_asigs.id_plan','=','asig_estudiante_asigs.id_plan')
                    ->on('asig_profe_asigs.id_salon','=','asig_estudiante_asigs.id_salon')
                    ->on('asig_profe_asigs.id_materia','=','asig_estudiante_asigs.id_materia');
                })->select('foro_aula_materias.*')->where('asig_estudiante_asigs.id_estudiante',$data->data->id)->paginate(5);
                return response()->json(["success" => true, "data" => $foro]);

            }
        }

        return response()->json(["success" => true, "data" => $foro]);
    }
    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        ForoAulaMaterias::whereIn('id', $arraIn)->delete();
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
}
