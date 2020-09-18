<?php

namespace App\Http\Controllers;

use App\ForoAulaComentarios;
use Illuminate\Http\Request;

class ForoAulaComentarioController extends Controller
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
     * @param  \Illuminate\Http\Request  $request|
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comentario = new ForoAulaComentarios();
        if (!empty($request->data["id"])) {
            $comentario = $comentario::find($request->data["id"]);
        }
        $comentario->id_foro = $request->data["foro"]["id"];
        $comentario->id_usuario = $request->data["usuario"]["id"];
        $comentario->id_foro = $request->data["foro"]["id"];
        if (!empty($request->data["comentario_padre"])) {
            $comentario->id_jerarquia_comentario = $request->data["comentario_padre"]["id"];
        }

        $comentario->comentario = $request->data["comentario"];
        $comentario->save();
        $foro = ForoAulaComentarios::with('foro')->with('usuario')->with('comentarioPadre')
        ->with('comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo')
        ->with('comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo.usuario')
        ->with('comentarioHijo.comentarioHijo.comentarioHijo.usuario')
        ->with('comentarioHijo.comentarioHijo.usuario')
        ->with('comentarioHijo.usuario')
        ->with('comentarioHijo.comentarioPadre')
        ->wherenull('id_jerarquia_comentario')
        ->where('id_foro', $comentario->id_foro)->orderby('id', 'desc')->get();
        return response()->json(["success" => true, "data" => $foro]);
    }
    /**
     *
     */
    public function getAll(Request $request)
    {
        $foro = ForoAulaComentarios::with('foro')->with('usuario')->with('comentarioPadre')
            ->with('comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo')
            ->with('comentarioHijo.comentarioHijo.comentarioHijo.comentarioHijo.usuario')
            ->with('comentarioHijo.comentarioHijo.comentarioHijo.usuario')
            ->with('comentarioHijo.comentarioHijo.usuario')
            ->with('comentarioHijo.usuario')
            ->with('comentarioHijo.comentarioPadre')
            ->wherenull('id_jerarquia_comentario')
            ->where('id_foro', $request["id"])->orderby('id', 'desc')->get();
        return response()->json(["success" => true, "data" => $foro]);
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
