<?php

namespace App\Http\Controllers;

use App\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
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
        $matricula = new Matricula();

        if (!empty($request["data"]["id"])) {
            $matricula = $matricula::find($request["data"]["id"]);
        }

        $matricula->id_escuela = $request["data"]["escuela"]["id"];
        $matricula->id_programa = $request["data"]["programa"]["id"];
        $matricula->id_estudiante = $request["data"]["estudiante"]["id"];
        $matricula->id_plan = $request["data"]["plan"]["id"];
        $matricula->id_sede = $request["data"]["sede"]["id"];
        $matricula->periodo = $request["data"]["periodo"];
        $matricula->ano_gravable = $request["data"]["ano_gravable"];

        $matricula->save();
        return response()->json(["success" => true, "data" => $matricula::with('programa')->with('estudiante')->with('sede')->with('plan')->with('escuela')->first()]);
    }
    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            return response()->json(["success" => true, "data" => Matricula::with('escuela')->with('programa')->with('plan')->with('sede')->with('estudiante')->whereHas('estudiante', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => Matricula::with('escuela')->with('programa')->with('plan')->with('sede')->with('estudiante')->paginate(5)]);
    }
    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Matricula::whereIn('id', $arraIn)->delete();
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
