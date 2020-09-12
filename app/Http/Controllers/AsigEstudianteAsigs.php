<?php

namespace App\Http\Controllers;

use App\AsigEstudianteAsig;
use Illuminate\Http\Request;

class AsigEstudianteAsigs extends Controller
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
        $asigEstudianteAsig = new AsigEstudianteAsig();

        if(!empty($request->data["id"])){
            $asigEstudianteAsig = $asigEstudianteAsig->find($request->data["id"]);
        }

        $asigEstudianteAsig->id_estudiante =$request->data["estudiante"]["id"];
        $asigEstudianteAsig->id_programa =$request->data["programa"]["id"];
        $asigEstudianteAsig->id_materia =$request->data["materia"]["id"];
        $asigEstudianteAsig->id_plan =$request->data["plan"]["id"];
        $asigEstudianteAsig->periodo =$request->data["periodo"];
        $asigEstudianteAsig->ano_gravable =$request->data["ano_gravable"];
        $asigEstudianteAsig->save();
        return response()->json(["success" => true, "data" => $asigEstudianteAsig->with('programa')->with('plan')->with('materia')->with('estudiante')->first()]);
    }

    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            return response()->json(["success" => true, "data" => AsigEstudianteAsig::with('programa')->with('plan')->with('materia')->with('estudiante')->whereHas('estudiante', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => AsigEstudianteAsig::with('programa')->with('plan')->with('materia')->with('estudiante')->paginate(5)]);
    }
    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        AsigEstudianteAsig::whereIn('id', $arraIn)->delete();
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
