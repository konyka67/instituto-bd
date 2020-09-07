<?php

namespace App\Http\Controllers;

use App\Materia;
use Illuminate\Http\Request;
use Mockery\Undefined;

class MateriaController extends Controller
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
        $materia = new Materia();

        if(!empty($request["data"]["id"])){
            $materia = Materia::find($request["data"]["id"]);
        }

        $materia->nombre=$request["data"]["nombre"];
        $materia->credito=$request["data"]["credito"];
        $materia->save();

        return response()->json(["success" => true, "data" => $materia]);
    }

    public function getPagination(Request $request)
    {
        if( !empty($request->buscar) && $request->buscar !== 'undefined'){
             return response()->json(["success" => true, "data" => Materia::where("nombre", "like", "%" . $request->buscar . "%")->orderBy("id")->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => Materia::orderBy("id")->paginate(5)]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Materia::whereIn('id', $arraIn)->delete();
        $this->refreshDB('materias');
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
