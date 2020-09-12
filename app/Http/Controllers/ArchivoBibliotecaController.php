<?php

namespace App\Http\Controllers;

use App\ActividadesAulaEstudiante;
use App\ArchivosBiblioteca;
use App\PptIntegrante;
use Illuminate\Http\Request;

class ArchivoBibliotecaController extends Controller
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
        $biblioteca = new ArchivosBiblioteca();
        if (!empty($request->biblioteca["id"])) {
            $biblioteca = ArchivosBiblioteca::find($request->biblioteca["id"]);
        }
        $biblioteca->nombre = $request->biblioteca["nombre"];
        $biblioteca->extension = $request->biblioteca["extension"];
        $biblioteca->tipo = $request->biblioteca["tipo"];
        $biblioteca->id_salon = $request->biblioteca["id_salon"];
        $biblioteca->id_programacion_horario = $request->biblioteca["id_programacion_horario"];
        $biblioteca->id_usuario = $request->biblioteca["id_usuario"];

        if (!empty($request->biblioteca["totalPaginas"])) {
            $biblioteca->totalPaginas = $request->biblioteca["totalPaginas"];
        }

        if (!empty($request->biblioteca["todos"])) {
            $biblioteca->permisos = $request->biblioteca["todos"];
        }

        $biblioteca->save();

        if ($biblioteca->extension === 'ppt') {
            foreach ($request->biblioteca["ppt_integrantes"] as $key => $value) {
                $pptIntegrante = new PptIntegrante();
                $pptIntegrante->id_usuario = $request->biblioteca["ppt_integrantes"][$key]["id"];
                $pptIntegrante->id_archivo = $biblioteca->id;
                $pptIntegrante->save();
            }
        }

        return response()->json(["success" => true, "data" => $biblioteca]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {

        $archivo = ArchivosBiblioteca::with("salon")->with("programacionHorario")->with('integrantes')
        ->whereHas('salon', function ($query) use ($request) {
            $query->where('id',$request->id_salon);
        })
        ->whereHas('programacionHorario', function ($query) use ($request) {
            $query->where('id', $request->id_programacion);
        })
        ->where("extension", $request->extension)->orderBy("id", "desc")->get();
        return response()->json(["success" => true, "data" => $archivo]);
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
