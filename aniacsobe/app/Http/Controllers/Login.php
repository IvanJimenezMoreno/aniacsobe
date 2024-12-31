<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
   public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['mensajeError'=>'Debes completar todos los campos para poeder iniciar sesión'], 400);
        }

        $usuario = Usuario::where('email', $request->email)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json(['mensajeError'=>'Email o contraseña incorrecta'], 401);
        }

        $token = $usuario->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            "token_type" => "Bearer",
            "usuario" => $usuario
        ]);

        
   }
}
