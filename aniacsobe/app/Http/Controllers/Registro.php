<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Registro extends Controller
{
    public function registro(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'nombre_usuario' => 'required|string|max:255|unique:usuarios',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'foto' => 'nullable|image',
            'rol' => 'required|string|in:Fundador,Consejo,Clero,Nobleza,Burguesia,Plebe',
            'admin' => 'boolean'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $request->foto,
            'rol' => $request->rol,
            'admin' => $request->admin
        ]);

        $usuario->sendEmailVerificationNotification();

        $token = $usuario->createToken('token')->plainTextToken;

        return response()->json(['token' => $token, 'token_type'=> 'Bearer'], 201);
    }

    
}
