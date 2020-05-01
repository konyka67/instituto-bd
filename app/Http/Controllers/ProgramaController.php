<?php

namespace App\Http\Controllers;

use App\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
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
        $programa = new Programa();

        if(!empty($request["programa"]["id"])){
            $programa= Programa::find($request["programa"]["id"]);
        }

        $programa->nombre = $request["programa"]["nombre"];
        $programa->save();

        return response()->json(["success" => true, "programa" => $programa]);
    }

      public function getPagination(Request $request)
    {
        if( !empty($request->buscar) && $request->buscar !== 'undefined'){
             return response()->json(["success" => true, "programa" => Programa::where("nombre", "like", "%" . $request->buscar . "%")->orderBy("id")->paginate(5)]);
        }
        return response()->json(["success" => true, "programa" => Programa::orderBy("id")->paginate(5)]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->programas as $programa) {
            array_push($arraIn, $programa["id"]);
        }
        Programa::whereIn('id', $arraIn)->delete();
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
