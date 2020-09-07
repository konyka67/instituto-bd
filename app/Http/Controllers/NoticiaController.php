<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\MultimediaNoticias;
use App\Multimedias;
use App\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticiaController extends Controller
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
        $noticiaRequest = json_decode($request->noticia);
        $noticia = new Noticia();

        if (!empty($noticiaRequest->id)) {
            $noticia = Noticia::find($noticiaRequest->id);
        }

        $noticia->titulo = $noticiaRequest->titulo;
        $noticia->descripcion = $noticiaRequest->descripcion;
        $noticia->save();
        foreach ($request->file('files') as $file) {

            $archivo = new Archivo($file);
            $archivo->guardarArchivoNoticia('noticias/');
            $multimedia = new Multimedias();
            $multimedia->nombre_extension = $archivo->getArchivoNombreExtension();
            $multimedia->save();
            $noticia->multimedias()->attach($multimedia->id);
        }

        return response()->json(["success" => true, "data" => $noticia->multimedias()]);
    }

    public function getPagination(Request $request)
    {

        if (!empty($request->buscar) && $request->buscar !== 'undefined') {
            $noticias = Noticia::where("titulo", "like", "%" . $request->buscar . "%")
                ->select(
                    DB::raw("CONCAT(substr(descripcion,1,40),'...') as descripcion"),
                    'titulo',
                    'id',
                    'created_at',
                    'updated_at',
                )
                ->orderBy('id')->paginate(5);
        } else {
            $noticias = Noticia::select(
                DB::raw("CONCAT(substr(descripcion,1,40),'...') as descripcion"),
                'titulo',
                'id',
                'created_at',
                'updated_at',
            )->orderBy('id')->paginate(5);
        }
        return response()->json(["success" => true, "data" => $noticias]);
    }

    public function delete(Request $request)
    {
        $arraIn = array();
        foreach ($request->datas as $data) {

            $noticia = Noticia::find($data["id"]);
            $noticia->multimedias()->detach();
            $noticia->delete();
        }
        $this->refreshDB('noticias');
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
