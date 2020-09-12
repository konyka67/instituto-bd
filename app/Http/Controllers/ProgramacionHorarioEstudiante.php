<?php

namespace App\Http\Controllers;

use App\ProHorarioEstudiante;
use Illuminate\Http\Request;

class ProgramacionHorarioEstudiante extends Controller
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
        $programacionEstudiante = new ProHorarioEstudiante();

        if(!empty($request["data"]["id"])){
            $programacionEstudiante = $programacionEstudiante->find($request["data"]["id"]);
        }
        $programacionEstudiante->id_estudiante = $request["data"]["estudiante"]["id"];
        $programacionEstudiante->id_programacion = $request["data"]["programacion_horario"]["id"];
        $programacionEstudiante->save();
        return response()->json(["success" => true, "data" => $programacionEstudiante::with('estudiante')->with('programacionHorario')->with('programacionHorario.asigProfeAsig.profesor')->with('programacionHorario.asigProfeAsig.salon')->with('programacionHorario.asigProfeAsig.materia')->with('programacionHorario.asigProfeAsig')->first()]);

    }
    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            return response()->json(["success" => true, "data" => ProHorarioEstudiante::with('estudiante')->with('programacionHorario')->with('programacionHorario.asigProfeAsig.profesor')->with('programacionHorario.asigProfeAsig.salon')->with('programacionHorario.asigProfeAsig.materia')->with('programacionHorario.asigProfeAsig')->whereHas('estudiante', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => ProHorarioEstudiante::with('estudiante')->with('programacionHorario')->with('programacionHorario.asigProfeAsig.profesor')->with('programacionHorario.asigProfeAsig.salon')->with('programacionHorario.asigProfeAsig.materia')->with('programacionHorario.asigProfeAsig')->paginate(5)]);
    }
    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        ProHorarioEstudiante::whereIn('id', $arraIn)->delete();
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
