<?php

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

