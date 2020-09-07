<?php

namespace App\Http\Controllers;

use App\PlanEstudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanEstudioController extends Controller
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
        $planEstudio = new PlanEstudio();

        if (!empty($request->data["programa"]["id"])) {
            $planEstudioNuevo = PlanEstudio::where("id_programa", $request->data["programa"]["id"])
                ->where("id_materia", $request->data["materia"]["id"])
                ->where("id_plan", $request->data["plan"]["id"])
                ->first();
            if (!empty($planEstudioNuevo) && !is_null($planEstudioNuevo)) {
                $planEstudio = $planEstudioNuevo;
            }
            $planEstudio->id_programa = $request->data["programa"]["id"];
            $planEstudio->id_materia = $request->data["materia"]["id"];
            $planEstudio->id_plan = $request->data["plan"]["id"];
        }
        $planEstudio->periodo = $request->data["periodo"];
        $planEstudio->fecha_inicial = $request->data["fecha_inicial"];
        $planEstudio->fecha_hasta = $request->data["fecha_hasta"];
        $planEstudio->save();

        $planEstudio->programa = $request->data["programa"];
        $planEstudio->materia = $request->data["materia"];
        $planEstudio->plan = $request->data["plan"];
        $planEstudio->compoundKey = "" . $planEstudio->id_programa . ',' . $planEstudio->id_materia . ',' . $planEstudio->id_plan . "";
        return response()->json(["success" => true, "data" => $planEstudio]);
    }

    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $planEstudio = PlanEstudio::select('id_programa', 'id_materia', 'id_plan', DB::raw("concat(id_programa,',',id_materia,',',id_plan) as compoundKey"), 'periodo', 'fecha_inicial', 'fecha_hasta')->with('materia')->with('plan')->with('programa')->whereHas('programa', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->groupBy('id_programa', 'id_materia', 'id_plan', 'periodo', 'fecha_inicial', 'fecha_hasta')->orderBy('id_programa')->paginate(5);
        } else {
            $planEstudio = PlanEstudio::select('id_programa', 'id_materia', 'id_plan', DB::raw("concat(id_programa,',',id_materia,',',id_plan) as compoundKey"), 'periodo', 'fecha_inicial', 'fecha_hasta')->with('materia')->with('plan')->with('programa')->groupBy('id_programa', 'id_materia', 'id_plan', 'periodo', 'fecha_inicial', 'fecha_hasta')->orderBy('id_programa')->paginate(5);
        }
        return response()->json(["success" => true, "data" => $planEstudio]);
    }

    public function delete(Request $request)
    {
        foreach ($request->datas as $data) {
            PlanEstudio::where("id_programa", $data["programa"]["id"])
                ->where("id_materia", $data["materia"]["id"])
                ->where("id_plan", $data["plan"]["id"])
                ->delete();
        }
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
