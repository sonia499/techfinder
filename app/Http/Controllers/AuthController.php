<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login_user'    => 'required|string',
            'password_user' => 'required|string',
        ]);

        $user = Utilisateur::where('login_user', $request->login_user)->first();

        if (!$user || !Hash::check($request->password_user, $user->password_user)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        if ($user->etat_user !== 'actif') {
            return response()->json(['message' => 'Compte inactif ou bloqué'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user'    => $user,
            'token'   => $token,
            'type'    => 'Bearer'
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
