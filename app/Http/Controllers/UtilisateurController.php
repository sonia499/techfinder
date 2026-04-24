<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        try {
            $utilisateurs = Utilisateur::all();
            return response()->json($utilisateurs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve utilisateurs', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_user' => 'required|string|max:255',
            'prenom_user' => 'required|string|max:255',
            'login_user' => 'required|string|max:255',
            'password_user' => 'required|string|max:255',
            'tel_user' => 'required|string|max:255',
            'sexe_user' => 'required|string|in:M,F',
            'role_user' => 'required|string|in:admin,technicien,client',
            'etat_user' => 'required|string|in:actif,inactif,bloque',
        ]);

        try {
            $utilisateur = Utilisateur::create($request->all());
            return response()->json($utilisateur, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create utilisateur', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Utilisateur $utilisateur)
    {
        return response()->json($utilisateur);
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        $validate = $request->validate([
            'nom_user' => 'required|string|max:255',
            'prenom_user' => 'required|string|max:255',
            'login_user' => 'required|string|max:255',
            'password_user' => 'required|string|max:255',
            'tel_user' => 'required|string|max:255',
            'sexe_user' => 'required|string|in:M,F',
            'role_user' => 'required|string|in:admin,technicien,client',
            'etat_user' => 'required|string|in:actif,inactif,bloque',
        ]);

        try {
            $utilisateur->update($validate);
            return response()->json($utilisateur, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update utilisateur', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Utilisateur $utilisateur)
    {
        try {
            $utilisateur->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete utilisateur', 'message' => $e->getMessage()], 500);
        }
    }
}
