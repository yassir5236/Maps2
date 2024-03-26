<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

  
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

   
    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // Ajoutez d'autres règles de validation au besoin
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mettre à jour l'utilisateur
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        // Mettez à jour d'autres champs si nécessaire
        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

   
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
