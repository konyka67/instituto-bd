<?php

namespace App\Http\Controllers;

use App\AsigProfeAsig;
use Illuminate\Http\Request;

class AsigPrfeAsigsController extends Controller
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
        $asigProfeAsigs = new AsigProfeAsig();

        if (!empty($request["data"]["id"])) {
            $asigProfeAsigs = AsigProfeAsig::find($request["data"]["id"]);
        }
        $asigProfeAsigs->id_programa = $request["data"]["programa"]["id"];
        if(!empty($request["data"]["profesor"])){
            $asigProfeAsigs->id_profesor = $request["data"]["profesor"]["id"];
        }
        $asigProfeAsigs->id_plan = $request["data"]["plan"]["id"];
        $asigProfeAsigs->id_salon = $request["data"]["salon"]["id"];
        $asigProfeAsigs->id_materia = $request["data"]["materia"]["id"];
        $asigProfeAsigs->cupos = $request["data"]["cupos"];
        $asigProfeAsigs->grupo = $request["data"]["grupo"];
        $asigProfeAsigs->save();
        $asigProfeAsigs = AsigProfeAsig::with('programa')->with('plan')->with('salon')->with('materia')->with('profesor')->find($asigProfeAsigs->id);

        return response()->json(["success" => true, "data" => $asigProfeAsigs]);
    }

    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            return response()->json(["success" => true, "data" => AsigProfeAsig::with('programa')->with('plan')->with('salon')->with('materia')->with('profesor')->whereHas('profesor', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => AsigProfeAsig::with('programa')->with('plan')->with('salon')->with('materia')->with('profesor')->paginate(5)]);
    }
    public function getAllObjectPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            return response()->json(["success" => true, "data" => AsigProfeAsig::with('programa')->with('plan')->with('salon')->with('materia')->with('profesor')
            ->whereHas('profesor', function ($query) use ($request) {
                $query->where('id', 'like', "%" . $request->id . "%");
            })
            ->whereHas('materia', function ($query) use ($request) {
                $query->where('nombre', 'like', "%" . $request->buscar . "%");
            })->paginate(5)]);
        }

        return response()->json(["success" => true, "data" => AsigProfeAsig::with('programa')->with('plan')->with('salon')->with('materia')->with('profesor')
        ->whereHas('profesor', function ($query) use ($request) {
            $query->where('id', 'like', "%" . $request->id . "%");
        })->paginate(5)]);
      }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        AsigProfeAsig::whereIn('id', $arraIn)->delete();
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
