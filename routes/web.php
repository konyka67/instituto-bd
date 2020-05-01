<?php

use App\Escuela;
use App\Materia;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    Mail::send('email',['usuario'=>$usuario,'password'=>'123'], function($msj) use($subject,$for){
        $msj->from("nuevojuanchaco67@gmail.com","instituto");
        $msj->subject($subject);
        $msj->to($for);
    });
    return "exitoso";
});
Route::get('/emailCorreo', function () {

        $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    return view('email',['usuario'=>$usuario,'password'=>'123']);
});
Route::get('/email', function () {

    $usuario = json_decode('{"id":"1","nombre":"juan camilo rodriguez","email":"admin@gmail.com"}');

    return view('email',['usuario'=>$usuario,'password'=>'123']);
});
// Route::post('/redireccionar', 'UsuarioController@redireccionarAccount');
Route::post('/redireccionar',  function (Request $request) {
    $email= $request->email;
    $password= $request->password;
    $id= $request->id;


     $usuario = json_decode('{"id":"","password":"","email":""}');
     $usuario->password=$password;
     $usuario->email=$email;
     $usuario->id=$id;
    return view("redirect-email",["usuario"=>$usuario]);
});
Route::get('/cony',  function (Request $request) {

    return Materia::orderBy("id")->paginate(5);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/prueba', 'SedeController@getPagination');
