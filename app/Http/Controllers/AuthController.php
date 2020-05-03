<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Localizacion;
use App\Role;
use App\RolUsuario;
use App\Usuario;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $usuario = Usuario::find(auth()->user()->id);
        $localizacion = Localizacion::find($usuario->id_localizacion);
        $usuario->localizacion = $localizacion;
        return response()->json($usuario);
    }



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['data' => true, 'mensaje' => 'Cierre de sesión exitoso']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array struc$rol->tipo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

        $usuario = Usuario::find(auth()->user()->id)->with('roles')->with('localizacion')->first();
        foreach ($usuario->roles as $rol) {
            if(!empty($rol->tipo) && $rol->tipo === app('request')->__get('tipo')){
                $rolNuevo = $rol;
                break;
            }
        }
        $usuario->rol = $rolNuevo;
        $usuario->token = $token;

        return response()->json([
            'access_token' => $token,
            'usuario' => $usuario,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
