<?php

namespace App\Http\Controllers;

use App\AsigProfeAsig;
use App\ProgramacionHorario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramacionHorarioController extends Controller
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

    public function store(Request $request)
    {
        $programacionHorario = new ProgramacionHorario();
        if(!empty($request->data["id"])){
            $programacionHorario = ProgramacionHorario::find($request->data["id"]);
        }
        $programacionHorario->hora_inicial = Carbon::createFromFormat('H:i a',$request->data["hora_inicial"]);
        $programacionHorario->hora_final = Carbon::createFromFormat('H:i a',$request->data["hora_final"]);
        $programacionHorario->id_asig_profe = $request->data["asig_profe_asig"]["id"];
        $programacionHorario->dia = $request->data["dia"];
        $programacionHorario->fecha_inicial =  Carbon::parse($request->data["fecha_inicial"]);
        $programacionHorario->fecha_final =  Carbon::parse($request->data["fecha_final"]);
        $programacionHorario->save();
        $programacionHorario = ProgramacionHorario::with('asigProfeAsig.programa')
        ->with('asigProfeAsig.plan')
        ->with('asigProfeAsig.salon')
        ->with('asigProfeAsig.materia')
        ->with('asigProfeAsig.profesor')->find($programacionHorario->id);
        return response()->json(["success" => true, "data" => $programacionHorario]);
    }
    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $programacionHorario= ProgramacionHorario::with('asigProfeAsig.programa')
            ->with('asigProfeAsig.plan')
            ->with('asigProfeAsig.salon')
            ->with('asigProfeAsig.materia')
            ->with('asigProfeAsig.profesor')
            ->whereHas('asigProfeAsig.programa', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })
            ->paginate(5);
        }else{
            $programacionHorario= ProgramacionHorario::with('asigProfeAsig.programa')
            ->with('asigProfeAsig.plan')
            ->with('asigProfeAsig.salon')
            ->with('asigProfeAsig.materia')
            ->with('asigProfeAsig.profesor')
            ->whereHas('asigProfeAsig.profesor', function ($query) use ($request) {
                $query->where('activo', 1);
            })
            ->paginate(5);
        }
        return response()->json(["success" => true, "data" => $programacionHorario]);
    }

    public function getAllObjectPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $programacionHorario= ProgramacionHorario::with('asigProfeAsig.programa')
            ->with('asigProfeAsig.plan')
            ->with('asigProfeAsig.salon')
            ->with('asigProfeAsig.materia')
            ->with('asigProfeAsig.profesor')
            ->whereHas('asigProfeAsig.materia', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })
            ->whereHas('asigProfeAsig.profesor', function ($query) use ($request) {
                $query->where('id',$request->data)->where('activo', 1);
            })
            // ->select('programacion_horarios.*',DB::raw("concat(".$request->data.",',',id) as compoundKey")

            ->paginate(5);
        }else{
            $programacionHorario= ProgramacionHorario::with('asigProfeAsig.programa')
            ->with('asigProfeAsig.plan')
            ->with('asigProfeAsig.salon')
            ->with('asigProfeAsig.materia')
            ->with('asigProfeAsig.profesor')
            ->whereHas('asigProfeAsig.profesor', function ($query) use ($request) {
                $query->where('id',$request->data)->where('activo', 1);
            })
            ->paginate(5);
        }
        return response()->json(["success" => true, "data" => $programacionHorario]);

    }
    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        ProgramacionHorario::whereIn('id', $arraIn)->delete();

        return response()->json(["success" => true]);
    }

    public function get(Request $request){
        $programacionHorario = ProgramacionHorario::with('asigProfeAsig.programa')
        ->with('asigProfeAsig.plan')
        ->with('asigProfeAsig.salon')
        ->with('asigProfeAsig.materia')
        ->with('asigProfeAsig.profesor')
        ->whereHas('asigProfeAsig.profesor', function ($query) use ($request) {
            $query->where('activo', 1);

        })->find($request->id);
        return response()->json(["success" => true , 'data'=>$programacionHorario]);
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
