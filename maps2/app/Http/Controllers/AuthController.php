<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
 
    public function register(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // return response()->json(['message' => 'User registered successfully'], 201);
        return redirect()->route('user.home');

        

    }


    public function login(Request $request)
    {
        // Validation des identifiants
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentification réussie, générer un token d'accès
            $token = auth()->user()->createToken('API Token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            // Échec de l'authentification
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

 
    public function logout(Request $request)
    {
        // Révocation du token d'accès de l'utilisateur connecté
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
