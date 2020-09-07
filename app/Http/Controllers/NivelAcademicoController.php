<?php

namespace App\Http\Controllers;

use App\NivelAcademico;
use Illuminate\Http\Request;

class NivelAcademicoController extends Controller
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
        $nivelAcademico = new NivelAcademico();

        if(!empty($request["data"]["id"])){
            $nivelAcademico = NivelAcademico::find($request["data"]["id"]);
        }

        $nivelAcademico->nombre=$request["data"]["nombre"];
        $nivelAcademico->tipo=$request["data"]["tipo"];
        $nivelAcademico->save();

        return response()->json(["success" => true, "data" => $nivelAcademico]);
    }

    public function getPagination(Request $request)
    {
        if( !empty($request->buscar) && $request->buscar !== 'undefined'){
             return response()->json(["success" => true, "data" => NivelAcademico::where("nombre", "like", "%" . $request->buscar . "%")->orderBy("id")->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => NivelAcademico::orderBy("id")->paginate(5)]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        NivelAcademico::whereIn('id', $arraIn)->delete();
        $this->refreshDB('nivel_academicos');
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
