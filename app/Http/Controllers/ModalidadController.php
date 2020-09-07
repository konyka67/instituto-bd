<?php

namespace App\Http\Controllers;

use App\Modalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ModalidadController extends Controller
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


        $modalidad = new Modalidad();

        if(!empty($request->data['id'])){
            $modalidad = Modalidad::find($request->data['id']);
        }

        $modalidad ->nombre = $request->data['nombre'];
        $modalidad ->tipo = $request->data['tipo'];
        $modalidad ->descripcion = $request->data['descripcion'];
        $modalidad ->save();

        return response()->json(["success" => true, "data" => $modalidad]);

    }

    public function getPagination(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $modalidad = Modalidad::where("nombre", "like", "%" . $request->buscar . "%")
                ->select(
                    DB::raw("CONCAT(substr(descripcion,1,40),'...') as descripcion"),
                    'nombre',
                    'tipo',
                    'id',
                    'created_at',
                    'updated_at',
                )
                ->orderBy('id')->paginate(5);
        } else {
            $modalidad = Modalidad::select(
                DB::raw("CONCAT(substr(descripcion,1,40),'...') as descripcion"),
                'nombre',
                'tipo',
                'id',
                'created_at',
                'updated_at',
            )->orderBy('id')->paginate(5);
        }
        return response()->json(["success" => true, "data" => $modalidad]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
        }
        Modalidad::whereIn('id', $arraIn)->delete();
        $this->refreshDB('modalidads');
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
