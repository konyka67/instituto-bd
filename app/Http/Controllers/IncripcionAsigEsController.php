<?php

namespace App\Http\Controllers;

use App\AsigProfeAsig;
use App\InscripcionAsigEs;
use App\ProHorarioEstudiante;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncripcionAsigEsController extends Controller
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
        //
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

    public function getPagination(Request $request)
    {
        // $inscripcionAsigEs = AsigProfeAsig::with('programa')
        // ->with('plan')
        // ->with('salon')
        // ->with('materia')
        // ->with('profesor')
        // ->join('programacion_horarios','asig_profe_asigs.id','programacion_horarios.id_asig_profe')
        // ->join('inscripcion_asig_es','asig_profe_asigs.id','inscripcion_asig_es.id_programacion')->first();


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

    public function getAllObjectPagination(Request $request)
    {

        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $inscripcionAsigEs = ProHorarioEstudiante::with('estudiante')->with('programacionHorario')->with('programacionHorario.asigProfeAsig.programa')->with('programacionHorario.asigProfeAsig.plan')->with('programacionHorario.asigProfeAsig.salon')->with('programacionHorario.asigProfeAsig.materia')->with('programacionHorario.asigProfeAsig.profesor')
                ->whereHas('estudiante', function ($query) use ($request) {
                    $query->where('id', $request->data);
                })
                ->whereHas('programacionHorario.asigProfeAsig.materia', function ($query) use ($request) {
                    $query->where('nombre', 'like', "%" . $request->buscar . "%");
                })->paginate(5);
        } else {

            $inscripcionAsigEs = ProHorarioEstudiante::with('estudiante')->with('programacionHorario')->with('programacionHorario.asigProfeAsig.programa')->with('programacionHorario.asigProfeAsig.plan')->with('programacion.asigProfeAsig.salon')->with('programacionHorario.asigProfeAsig.materia')->with('programacionHorario.asigProfeAsig.profesor')
                ->whereHas('estudiante', function ($query) use ($request) {
                    $query->where('id', $request->data);
                })
                ->paginate(5);
        }
        return response()->json(["success" => true, "data" => $inscripcionAsigEs]);
    }

    public function get(Request $request)
    {
        $idEstudiante = explode(",", $request->id)[0];
        $idProgrmacion = explode(",", $request->id)[1];

        $inscripcionAsigEs = InscripcionAsigEs::with('estudiante')->with('programacion.asigProfeAsig.programa')->with('programacion.asigProfeAsig.plan')->with('programacion.asigProfeAsig.salon')->with('programacion.asigProfeAsig.materia')->with('programacion.asigProfeAsig.profesor')
            ->where('id_estudiante', $idEstudiante)->where('id_programacion', $idProgrmacion)
            ->select('inscripcion_asig_es.*', DB::raw("concat(id_estudiante,',',id_programacion) as compoundKey"))
            ->first();

        return response()->json(["success" => true, "data" => $inscripcionAsigEs]);
    }

    public function getEstudiante(Request $request)
    {
        $inscripcionAsigEs = InscripcionAsigEs::with('estudiante')->with('programacion.asigProfeAsig.programa')->with('programacion.asigProfeAsig.plan')->with('programacion.asigProfeAsig.salon')->with('programacion.asigProfeAsig.materia')->with('programacion.asigProfeAsig.profesor')
            ->whereHas('estudiante', function ($query) use ($request) {
                $query->where('id', $request->data);
            })
            ->select('inscripcion_asig_es.*', DB::raw("concat(id_estudiante,',',id_programacion) as compoundKey"))
            ->get();

        return response()->json(["success" => true, "data" => $inscripcionAsigEs]);
    }
}
