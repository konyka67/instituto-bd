<?php

use App\AsigProfeAsig;
use App\Escuela;
use App\EscuelaUsuario;
use App\InscripcionAsigEs;
use App\Localizacion;
use App\Materia;
use App\MateriasLinea;
use App\PlanEstudio;
use App\ProgramacionHorario;
use App\Role;
use App\RolUsuario;
use App\Sede;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use NcJoes\OfficeConverter\OfficeConverter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $subject = "quiero cuquita rica para horita";
    // $for = "ing.constanza1@gmail.com";
    // $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    // Mail::send('email', ['usuario' => $usuario, 'password' => '123'], function ($msj) use ($subject, $for) {
    //     $msj->from("nuevojuanchaco67@gmail.com", "instituto");
    //     $msj->subject($subject);
    //     $msj->to($for);
    // });
    return "exitoso";
});
Route::get('/convertir', function () {

    // $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    // return view('email', ['usuario' => $usuario, 'password' => '123']);
    $path = public_path('archivos');
    // echo $path;
    $converter = new OfficeConverter($path.'/pptx/MonitorPPT1.pptx');
    $converter->convertTo('output-file.pdf'); //generates pdf file in same directory as test-file.docx
    $pdf = new \Spatie\PdfToImage\Pdf($path.'/pptx/output-file.pdf');
    // $pdf->saveImage($path.'/pptx/output-file.jpg');
    $pages = $pdf->getNumberOfPages();
    echo $pages;
    // for($i=1;$i<=$pages;$i++){
    //     $pdf->setPage(2)->saveImage($path."/pptx/MonitorPPT1$i.jpg");
    // }

});
Route::get('/email', function () {

    $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    return view('email', ['usuario' => $usuario, 'password' => '123']);
});
// Route::post('/redireccionar', 'UsuarioController@redireccionarAccount');
Route::post('/redireccionar',  function (Request $request) {
    $email = $request->email;
    $password = $request->password;
    $id = $request->id;


    $usuario = json_decode('{"id":"","password":"","email":""}');
    $usuario->password = $password;
    $usuario->email = $email;
    $usuario->id = $id;
    return view("redirect-email", ["usuario" => $usuario]);
});
Route::get('/uno',  function (Request $request) {

    // $usuarios = Usuario::where("usuarios.nombre", "like", "%" .'camilo' . "%")->first();
    $usuarios = Usuario::with('localizacion')->where("usuarios.nombre", "like", "%" . '' . "%")->get();
    // return $usuarios;
    // foreach ($usuarios as $usuario) {
    //     $usuario->localizacion=$usuario->localizacion;
    // }
    // echo $usuarios;
    return response()->json(["usuarios" => $usuarios]);
});

Route::get('/muchos',  function (Request $request) {

    $localizacion = Localizacion::with('usuarios')->get();
    return response()->json(["localizacion" => $localizacion]);
});

Route::get('/materia/muchos',  function (Request $request) {

    $materia = Materia::with('materiasOrigen')->with('materias')->get();
    return response()->json(["materias" => $materia]);
});
Route::get('/materia/linea/',  function (Request $request) {
    //     $lineaMaterias = Materia::with('materiasOrigen')->with('materias')->join(
    //         "materias_lineas",
    //         "materias.id",
    //         "materias_lineas.id_materia_origen"
    //     )->join(
    //         "materias as materias_m",
    //         "materias_lineas.id_materia",
    //         "materias_m.id"
    //     )
    //         ->orderBy('materias.id', 'asc')
    //         ->select(
    //             'materias_lineas.*',
    //             'materias.id as id_o',
    //             'materias.nombre as nombre_o',
    //             'materias.credito as credito_o',
    //             'materias.created_at as created_at_o',
    //             'materias.updated_at as updated_at_o',
    //             'materias_m.id as id_m',
    //             'materias_m.nombre as nombre_m',
    //             'materias_m.credito as credito_m',
    //             'materias_m.created_at as created_at_m',
    //             'materias_m.updated_at as updated_at_m',
    //         )->get();

    //         MateriasLinea::with('materiaOrigen')->with('materia')
    // return $lineaMaterias;




    // $term = 'c';
    // $materia = MateriasLinea::join('materias', 'materias_lineas.id_materia_origen', 'materias.id')
    //     ->join(
    //         "materias as materias_m",
    //         "materias_lineas.id_materia",
    //         "materias_m.id"
    //     )->where('materias.nombre', 'like', '%' . $term . '%')->select("materias_lineas.*")->orderBy('materias.id', 'asc')->with('materiaOrigen')->with('materia')->paginate(5);

    // $inscripcionAsigEs = AsigProfeAsig::with('programa')
    // ->with('plan')
    // ->with('salon')
    // ->with('materia')
    // ->with('profesor')
    // ->join('programacion_horarios','asig_profe_asigs.id','programacion_horarios.id_asig_profe')
    // ->join('inscripcion_asig_es','programacion_horarios.id','inscripcion_asig_es.id_programacion')
    // ->join('usuarios','inscripcion_asig_es.id_estudiante','usuarios.id')
    // ->first();
                                                                                        // / with('plan')->with('salon')->with('materia')->with('profesor')
    // $inscripcionAsigEs = InscripcionAsigEs::with('programacion.asigProfeAsigs.programa')->get();
    // $inscripcionAsigEs = AsigProfeAsig::with('programaciones.estudiantes')->whereHas('programaciones.estudiantes', function ($query) use ($request) {
    //     $query->where('id', 7);
    // })->get();




    // $inscripcionAsigEs = InscripcionAsigEs::with('estudiantes')->with('programaciones.asigProfeAsig.programa')->with('programaciones.asigProfeAsig.plan')->with('programaciones.asigProfeAsig.salon')->with('programaciones.asigProfeAsig.materia')->with('programaciones.asigProfeAsig.profesor')
    // ->whereHas('estudiantes', function ($query) use ($request) {
    //     $query->where('id',7);
    // })
    // ->get();
    //  return $inscripcionAsigEs;


    // $programacion = ProgramacionHorario::with('asigProfeAsig.programa')
    // ->with('asigProfeAsig.plan')
    // ->with('asigProfeAsig.salon')
    // ->with('asigProfeAsig.materia')
    // ->with('asigProfeAsig.profesor')
    // ->select(
    //     'programacion_horarios.*'
    // )->get();
        // return $programacion;

        // $inscripcionAsigEs = InscripcionAsigEs::with('estudiante')->with('programacion.asigProfeAsig.programa')->with('programacion.asigProfeAsig.plan')->with('programacion.asigProfeAsig.salon')->with('programacion.asigProfeAsig.materia')->with('programacion.asigProfeAsig.profesor')
        // ->whereHas('estudiante', function ($query) use ($request) {
        //     $query->where('id', 7);
        // })
        // // ->join('programacion_horarios','inscripcion_asig_es.id_programacion','programacion_horarios.id')
        // // ->join('asig_profe_asigs','programacion_horarios.id_asig_profe','asig_profe_asigs.id')
        // ->select('inscripcion_asig_es.*')
        // ->select()
        // ->paginate(5);

        // return $inscripcionAsigEs;


        // $programacionHorario= ProgramacionHorario::with('asigProfeAsig.programa')
        // ->with('asigProfeAsig.plan')
        // ->with('asigProfeAsig.salon')
        // ->with('asigProfeAsig.materia')
        // ->with('asigProfeAsig.profesor')
        // ->whereHas('asigProfeAsig.profesor', function ($query) use ($request) {
        //     $query->where('id',2);
        // })
        // ->paginate(5);
        // $programa = ni

        // return $programacionHorario;
});


Route::get('/sede/localizacion',  function (Request $request) {

    // $localizacion = Localizacion::with('sedes')->get();
    // return response()->json(["localizacion" => $localizacion]);

    $sede = Sede::with('localizacion')->get();
    return response()->json(["sede" => $sede]);
});

Route::get('/escuela/sede',  function (Request $request) {

    // $sede = Sede::with('escuelas')->get();
    // return response()->json(["sede" => $sede]);

    $escuela = Escuela::with('sede')->get();
    return response()->json(["escuela" => $escuela]);
});

Route::get('/usuario/escuelas',  function (Request $request) {

    $usuarios = Usuario::find(2);

    $usuarios->escuelas()->attach(1);

    $usuarios = $usuarios->with('escuelas');

    return response()->json(["usuarios" => $usuarios]);
});

Route::get('/escuelas/usuarios',  function (Request $request) {

    $usuarios = EscuelaUsuario::with('escuela')->with('usuario')->get();

    return response()->json(["usuarios" => $usuarios]);
});

Route::get('/usuario/roles',  function (Request $request) {

    // $usuarios = RolUsuario::with('rol')
    // ->with('usuario')->join('usuarios', 'rol_usuarios.id_usuario', 'usuarios.id')
    //     ->join('roles', 'rol_usuarios.id_rol', 'roles.id')
    //     ->where('roles.tipo', '=', 'AD')
    //     ->where('usuario.nombre')
    //     ->select('rol_usuarios.*')
    //     ->get();
    // return response()->json(["usuarios" => $usuarios]);

    // $usuario = Usuario::find(1)->with('roles')->with('localizacion')->first();

    // foreach ($usuario->roles as $role) {
    //     echo $role->nombre;
    // }

    // return $usuario;
    // Role::find(3)->usuarios()->sync(1);
    // Role::where('tipo','=','SE')->usuarios()->sync(1)->first();


    // $planEstudio = PlanEstudio::find(["id_programa" => 1, "id_materia" => 1, "id_plan" => 1]);
    // $planEstudio = PlanEstudio::find(["1","1","1"]);
        // $planEstudio = PlanEstudio::with('programa')->with('materia')->with('plan')->whereHas('programa', function ($query) {
        //     $query->where('nombre', 'like', '%ing%');
        // })->orderBy("id_programa")->get();
        // $tipo='PR';
        // $usuariosPagination = Usuario::with('localizacion')->with('roles')
        // ->whereHas('roles', function ($query) use ($tipo) {
        //     $query->where('tipo', $tipo);
        // })->select('usuarios.*')->orderBy("usuarios.id")->paginate(5);
        return ProgramacionHorario::join('asig_profe_asigs','programacion_horarios.id_asig_profe','asig_profe_asigs.id')
        ->join('programas','asig_profe_asigs.id_programa','programas.id')
        ->where('programas.nombre', 'like', "%ing%")
        ->select('programacion_horarios.*')->with('asigProfeAsigs')->whereHas('asigProfeAsigs', function ($query) use ($request) {
            $query->whit('programa');
        })->get();

    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/prueba', 'SedeController@getPagination');
