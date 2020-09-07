<?php

namespace App\Http\Controllers;

use App\Plane;
use Illuminate\Http\Request;

class PlanController extends Controller
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
        $plan = new Plane();

        if(!empty($request["data"]["id"])){
            $plan= Plane::find($request["data"]["id"]);
        }

        $plan->nombre = $request["data"]["nombre"];
        $plan->save();

        return response()->json(["success" => true, "plan" => $plan]);
    }

      public function getPagination(Request $request)
    {
        if( !empty($request->buscar) && $request->buscar !== 'undefined'){
             return response()->json(["success" => true, "data" => Plane::where("nombre", "like", "%" . $request->buscar . "%")->orderBy("id")->paginate(5)]);
        }
        return response()->json(["success" => true, "data" => Plane::orderBy("id")->paginate(5)]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Plane::whereIn('id', $arraIn)->delete();
        $this->refreshDB('planes');
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
