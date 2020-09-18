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
    return response()->json(["escuelas" => $esceulas]);
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
    Route::post('delete', 'UsuarioController@deleteUsers');
    Route::get('get-all-pagination', 'UsuarioController@allUsersTipo');
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
    'prefix' => 'escuela',
], function ($router) {
    Route::post('store', 'EscuelaController@store');
    Route::get('get-all-pagination', 'EscuelaController@getPagination');
    Route::post('delete', 'EscuelaController@delete');
    Route::get('get', 'EscuelaController@get');
});




Route::group([
    'middleware' => 'api',
    'prefix' => 'escuela-programa',
], function ($router) {
    Route::post('store', 'EscuelaProgramaController@store');
    Route::get('get-all-pagination', 'EscuelaProgramaController@getPagination');
    Route::post('delete', 'EscuelaProgramaController@delete');
    Route::get('get', 'EscuelaProgramaController@get');
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
    'prefix' => 'asignatura',
], function ($router) {
    Route::post('store', 'MateriaController@store');
    Route::get('get-all-pagination', 'MateriaController@getPagination');
    Route::post('delete', 'MateriaController@delete');
    Route::get('get', 'MateriaController@get');
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
    'prefix' => 'modalidad',
], function ($router) {
    Route::post('store', 'ModalidadController@store');
    Route::get('get-all-pagination', 'ModalidadController@getPagination');
    Route::post('delete', 'ModalidadController@delete');
    Route::get('get', 'ModalidadController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'nivel-educativo',
], function ($router) {
    Route::post('store', 'NivelAcademicoController@store');
    Route::get('get-all-pagination', 'NivelAcademicoController@getPagination');
    Route::post('delete', 'NivelAcademicoController@delete');
    Route::get('get', 'NivelAcademicoController@get');
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
    'prefix' => 'programa-modalidad',
], function ($router) {
    Route::post('store', 'ProgramaModalidadController@store');
    Route::get('get-all-pagination', 'ProgramaModalidadController@getPagination');
    Route::post('delete', 'ProgramaModalidadController@delete');
    Route::get('get', 'ProgramaModalidadController@get');
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


Route::group([
    'middleware' => 'api',
    'prefix' => 'plan-estudio',
], function ($router) {
    Route::post('store', 'PlanEstudioController@store');
    Route::get('get-all-pagination', 'PlanEstudioController@getPagination');
    Route::post('delete', 'PlanEstudioController@delete');
    Route::get('get', 'PlanEstudioController@get');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'noticia',
], function ($router) {
    Route::post('store', 'NoticiaController@store');
    Route::get('get-all-pagination', 'NoticiaController@getPagination');
    Route::post('delete', 'NoticiaController@delete');
    Route::get('get', 'NoticiaController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'salon',
], function ($router) {
    Route::post('store', 'SalonController@store');
    Route::get('get-all-pagination', 'SalonController@getPagination');
    Route::post('delete', 'SalonController@delete');
    Route::get('get', 'SalonController@get');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'asig-profe-asigs',
], function ($router) {
    Route::post('store', 'AsigPrfeAsigsController@store');
    Route::get('get-all-pagination', 'AsigPrfeAsigsController@getPagination');
    Route::post('delete', 'AsigPrfeAsigsController@delete');
    Route::get('get', 'AsigPrfeAsigsController@get');
    Route::get('get-all-object-pagination', 'AsigPrfeAsigsController@getAllObjectPagination');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'programacion-horario',
], function ($router) {
    Route::post('store', 'ProgramacionHorarioController@store');
    Route::get('get-all-pagination', 'ProgramacionHorarioController@getPagination');
    Route::post('delete', 'ProgramacionHorarioController@delete');
    Route::get('get', 'ProgramacionHorarioController@get');
    Route::get('get-all-object-pagination', 'ProgramacionHorarioController@getAllObjectPagination');
});


// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'programacion-horario',
// ], function ($router) {
//     Route::post('store', 'ProgramacionHorarioController@store');
//     Route::get('get-all-pagination', 'ProgramacionHorarioController@getPagination');
//     Route::post('delete', 'ProgramacionHorarioController@delete');
//     Route::get('get', 'ProgramacionHorarioController@get');
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'incripcion-horario-estudiante',
], function ($router) {
    Route::post('store', 'IncripcionAsigEsController@store');
    Route::get('get-all-pagination', 'IncripcionAsigEsController@getPagination');
    Route::post('delete', 'IncripcionAsigEsController@delete');
    Route::get('get', 'IncripcionAsigEsController@get');
    Route::get('get-all-object-pagination', 'IncripcionAsigEsController@getAllObjectPagination');
    Route::get('get-estudiante','IncripcionAsigEsController@getEstudiante');
});

Route::group([
    'prefix' => 'archivo-biblioteca',
], function ($router) {
    Route::post('store', 'ArchivoBibliotecaController@store');
    Route::get('get-all-pagination', 'ArchivoBibliotecaController@getPagination');
    Route::post('delete', 'ArchivoBibliotecaController@delete');
    Route::get('get', 'ArchivoBibliotecaController@get');
    Route::get('get-all-object-pagination', 'ArchivoBibliotecaController@getAllObjectPagination');
    Route::get('get-all', 'ArchivoBibliotecaController@getAll');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'archivo-biblioteca-jwt',
], function ($router) {
    Route::post('store', 'ArchivoBibliotecaController@store');
    Route::get('get-all-pagination', 'ArchivoBibliotecaController@getPagination');
    Route::post('delete', 'ArchivoBibliotecaController@delete');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'asig-estudiante-asigs',
], function ($router) {
    Route::post('store', 'AsigEstudianteAsigs@store');
    Route::get('get-all-pagination', 'AsigEstudianteAsigs@getPagination');
    Route::post('delete', 'AsigEstudianteAsigs@delete');
    Route::get('get', 'AsigEstudianteAsigs@get');
    Route::get('get-all-object-pagination', 'AsigEstudianteAsigs@getAllObjectPagination');
    Route::get('get-all', 'AsigEstudianteAsigs@getAll');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'matricula',
], function ($router) {
    Route::post('store', 'MatriculaController@store');
    Route::get('get-all-pagination', 'MatriculaController@getPagination');
    Route::post('delete', 'MatriculaController@delete');
    Route::get('get', 'MatriculaController@get');
    Route::get('get-all-object-pagination', 'MatriculaController@getAllObjectPagination');
    Route::get('get-all', 'MatriculaController@getAll');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'programacion-horario-estudiante',
], function ($router) {
    Route::post('store', 'ProgramacionHorarioEstudiante@store');
    Route::get('get-all-pagination', 'ProgramacionHorarioEstudiante@getPagination');
    Route::post('delete', 'ProgramacionHorarioEstudiante@delete');
    Route::get('get', 'ProgramacionHorarioEstudiante@get');
    Route::get('get-all-object-pagination', 'ProgramacionHorarioEstudiante@getAllObjectPagination');
    Route::get('get-all', 'ProgramacionHorarioEstudiante@getAll');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'foro-aula-materia',
], function ($router) {
    Route::post('store', 'ForoAulaMateriaController@store');
    Route::get('get-all-pagination', 'ForoAulaMateriaController@getPagination');
    Route::post('delete', 'ForoAulaMateriaController@delete');
    Route::get('get', 'ForoAulaMateriaController@get');
    Route::get('get-all-object-pagination', 'ForoAulaMateriaController@getAllObjectPagination');
    Route::get('get-all', 'ForoAulaMateriaController@getAll');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'foro-aula-comentario',
], function ($router) {
    Route::post('store', 'ForoAulaComentarioController@store');
    Route::get('get-all-pagination', 'ForoAulaComentarioController@getPagination');
    Route::get('get-all', 'ForoAulaComentarioController@getAll');
});
