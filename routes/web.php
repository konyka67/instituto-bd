<?php

use App\Escuela;
use App\EscuelaUsuario;
use App\Localizacion;
use App\Materia;
use App\MateriasLinea;
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
use Symfony\Component\Console\Output\ConsoleOutput;

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
    $subject = "quiero cuquita rica para horita";
    $for = "ing.constanza1@gmail.com";
    $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    Mail::send('email', ['usuario' => $usuario, 'password' => '123'], function ($msj) use ($subject, $for) {
        $msj->from("nuevojuanchaco67@gmail.com", "instituto");
        $msj->subject($subject);
        $msj->to($for);
    });
    return "exitoso";
});
Route::get('/emailCorreo', function () {

    $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    return view('email', ['usuario' => $usuario, 'password' => '123']);
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




    $term = 'c';
    $materia = MateriasLinea::join('materias', 'materias_lineas.id_materia_origen', 'materias.id')
        ->join(
            "materias as materias_m",
            "materias_lineas.id_materia",
            "materias_m.id"
        )->where('materias.nombre', 'like', '%' . $term . '%')->select("materias_lineas.*")->orderBy('materias.id', 'asc')->with('materiaOrigen')->with('materia')->paginate(5);
    return $materia;
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
    Role::where('tipo','=','SE')->usuarios()->sync(1)->first();
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/prueba', 'SedeController@getPagination');
