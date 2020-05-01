<?php

use App\Escuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/escuelas', function () {
    $esceulas = Escuela::all()->paginate(5);
    return response()->json(["escuelas"=>$esceulas]);
});



Route::get('/paginacion', function () {
    $areas = App\Area::paginate(5);

    //return $areas->items();
    return $areas;
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('store', 'UsuarioController@store');
    Route::post('delete-users', 'UsuarioController@deleteUsers');
    Route::get('all-users-tipo', 'UsuarioController@allUsersTipo');
    Route::get('get-user', 'UsuarioController@getUser');
});

// Route::get('v1/users','UsuarioController@getDian');
// Route::post('v1/users','UsuarioController@postDian');


Route::group([
    'middleware' => 'api',
    'prefix' => 'sede',
], function ($router) {
    Route::post('store', 'SedeController@store');
    Route::get('get-all-pagination', 'SedeController@getPagination');
    Route::post('delete', 'SedeController@delete');
    Route::get('get', 'SedeController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'materia',
], function ($router) {
    Route::post('store', 'MateriaController@store');
    Route::get('get-all-pagination', 'MateriaController@getPagination');
    Route::post('delete', 'MateriaController@delete');
    Route::get('get', 'MateriaController@get');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'escuela',
], function ($router) {
    Route::post('store', 'EscuelaController@store');
    Route::get('get-all-pagination', 'EscuelaController@getPagination');
    Route::post('delete', 'EscuelaController@delete');
    Route::get('get', 'EscuelaController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'escuela-usuario',
], function ($router) {
    Route::post('store', 'EscuelaUsuarioController@store');
    Route::get('get-all-pagination', 'EscuelaUsuarioController@getPagination');
    Route::post('delete', 'EscuelaUsuarioController@delete');
    Route::get('get', 'EscuelaUsuarioController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'configuracion',
], function ($router) {
    Route::post('store', 'ConfiguracionController@store');
    Route::get('get-all-configuration', 'ConfiguracionController@getAllConfiguration');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'linea-asignatura',
], function ($router) {
    Route::post('store', 'LineMateriaController@store');
    Route::get('get-all-pagination', 'LineMateriaController@getPagination');
    Route::post('delete', 'LineMateriaController@delete');
    Route::get('get', 'LineMateriaController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'programa',
], function ($router) {
    Route::post('store', 'ProgramaController@store');
    Route::get('get-all-pagination', 'ProgramaController@getPagination');
    Route::post('delete', 'ProgramaController@delete');
    Route::get('get', 'ProgramaController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'plan',
], function ($router) {
    Route::post('store', 'PlanController@store');
    Route::get('get-all-pagination', 'PlanController@getPagination');
    Route::post('delete', 'PlanController@delete');
    Route::get('get', 'PlanController@get');
});
