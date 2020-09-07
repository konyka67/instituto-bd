<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Ciudad;
use App\Departamento;
use App\Direccion;
use App\Localizacion;
use App\Email;
use App\Pais;
use App\Role;
use App\RolUsuario;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacion = $this->validaciones($request);
        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 422);
        }

        $usuario = new Usuario();
        $user = json_decode($request->usuario);
        //cuando el id existe es porque esta actualizando los datos de la persona
        if (!empty($user->id)) {
            $usuario = Usuario::find($user->id);
            $id = $user->id;
        }
        $usuario->nombre = $user->nombre;
        $usuario->nombre_uno = $user->nombre_uno;
        if (!empty($user->nombre_dos)) {
            $usuario->nombre_dos = $user->nombre_dos;
        }
        $usuario->apellido_uno = $user->apellido_uno;
        if (!empty($user->apellido_dos)) {
            $usuario->apellido_dos = $user->apellido_dos;
        }
        if (!empty($user->telefono)) {
            $usuario->telefono = $user->telefono;
        }
        $usuario->celular = $user->celular;
        //FECHA DE NACIMIENTO
        if (!empty($user->fechanacimiento)) {
            $format = str_replace('Z', '', str_replace('T', ' ', $user->fechanacimiento));
            $usuario->fechanacimiento = Carbon::createFromFormat("Y-m-d H:i:s.u", $format);
        }
        $localizacion = $user->localizacion;
        //PARA BUSCAR O GURDAR LA LOCALIZACION
        if (!empty($localizacion)) {
            $direccion = new Direccion($localizacion->direccion);
            $direccion->ejecutar();
            if (!$direccion->isEmpty()) {
                $pais = new Pais();
                $departamento = new Departamento();
                $ciudad = new Ciudad();
                $pais = $pais->buscar($direccion->getPais());
                $departamento = $departamento->buscar($direccion->getDepartamento(), $pais);
                $ciudad = $ciudad->buscar($direccion->getCiudad(), $departamento);
                $localizacionTable = new Localizacion();
                $localizacionTable = $localizacionTable->buscar($localizacion->latitud, $localizacion->longitud, $direccion->getDireccion(), $ciudad);
                $usuario->id_localizacion = $localizacionTable->id;
            }
        }
        $usuario->cedula = $user->cedula;
        $usuario->tipo = $user->tipo;



        $usuario->sex = $user->sex;
        $usuario->email = $user->email;

        if (!empty($request->update) && $request->update == 'false') {
            $generadorPassword = $this->generateRandomString();
            $usuario->password = Hash::make($generadorPassword);
        }
        //ALMACENAR LA IMAGEN DEL USUARIO
        if (!empty($request->hasFile('file'))) {
            $archivo = new Archivo($request->file('file'));
            $archivo->guardarArchivo($usuario);
            $usuario->foto = $archivo->getArchivoNombreExtension();
        } else {

            switch ($usuario->tipo) {
                case 'PR':
                    switch ($usuario->sex) {
                        case 'M':
                            $usuario->foto = 'default_profesor_m.png';
                            break;
                        case 'F':
                            $usuario->foto = 'default_profesor_f.png';
                            break;
                    }
                    break;

                case 'AD':
                    switch ($usuario->sex) {
                        case 'M':
                            $usuario->foto = 'default_admin_m.png';
                            break;
                        case 'F':
                            $usuario->foto = 'default_admin_f.png';
                            break;
                    }
                    break;

                case 'ES':
                    switch ($usuario->sex) {
                        case 'M':
                            $usuario->foto = 'default_estudiante_m.png';
                            break;
                        case 'F':
                            $usuario->foto = 'default_estudiante_F.png';
                            break;
                    }
                    break;
                default:
                    switch ($usuario->sex) {
                        case 'M':
                            $usuario->foto = 'default_estudiante_m.png';
                            break;
                        case 'F':
                            $usuario->foto = 'default_estudiante_F.png';
                            break;
                    }
                    break;
            }
        }
        $usuario->save();
        Role::where('tipo', '=', $user->tipo)->first()->usuarios()->sync($usuario->id);
        //cuando el id existe es porque esta actualizando los datos de la persona
        if (empty($id)) {
            $email = new Email();
            $email->send("Institución educativa", $usuario->email, ["usuario" => $usuario, "password" => $generadorPassword]);
        }
        if (!empty($user->token)) {
            $usuario->token = $user->token;
        }
        $usuario->localizacion = $localizacionTable;
        return response()->json(["success" => true, "usuario" => $usuario]);
    }

    /**
     *
     */
    public function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function validaciones(Request $request)
    {
        $regla   = [
            'nombre_uno'    => 'required',
            'apellido_uno'  => 'required',
            'nombre'        => 'required',
            'email'         => 'required',
            'cedula'        => 'required',
            'celular'       => 'required',
            'sex'           => 'required'
        ];
        $mensaje = [
            'required' => 'El campo :attribute es obligatorio'
        ];

        $validator = Validator::make((array) json_decode($request->usuario), $regla, $mensaje);
        return  $validator;
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

    public function redireccionarAccount(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $id = $request->id;


        $usuario = json_decode('{"id":"","password":"","email":""}');
        $usuario->password = $password;
        $usuario->email = $email;
        $usuario->id = $id;
        return view('redirect-email', ["usuario" => $usuario]);
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

    public function allUsersTipo(Request $request)
    {
        if (!empty($request->buscar) && $request->buscar !== 'undefined') {

            $usuariosPagination = Usuario::with('localizacion')->with('roles')
                ->whereHas('roles', function ($query) use ($request) {
                    $query->where('tipo', $request->tipo);
                })
                ->where("usuarios.nombre", "like", "%" . $request->buscar . "%")
                ->select('usuarios.*')->orderBy("usuarios.id")->paginate(5);
        } else {
            $usuariosPagination = Usuario::with('localizacion')->with('roles')
                ->whereHas('roles', function ($query) use ($request) {
                    $query->where('tipo', $request->tipo);
                })->select('usuarios.*')->orderBy("usuarios.id")->paginate(5);
        }

        return response()->json(["success" => true, "data" => $usuariosPagination]);
    }

    public function deleteUsers(Request $request)
    {   $arraIn = array();
        foreach ($request->datas as $data) {
            array_push($arraIn, $data["id"]);
            $eliminar = Usuario::find($data["id"]);
            $eliminar -> roles()->detach();
            $eliminar -> delete();
        }
        $this->refreshDB('usuarios');

        return response()->json(["success" => true]);
    }


    public function getUser(Request $request)
    {
        $usuario = Usuario::where("id", $request->id)->first();
        $localizacion = Localizacion::find($usuario->id_localizacion);
        $usuario->localizacion = $localizacion;
        return response()->json(["success" => true, "usuario" => $usuario]);
    }


}
