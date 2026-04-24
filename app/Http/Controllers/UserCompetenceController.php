<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Competence;
use Illuminate\Http\Request;

class UserCompetenceController extends Controller
{
    /**
     * Attach a competence to a user (assigner une compétence à un utilisateur)
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_user' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);

        try {
            $utilisateur = Utilisateur::findOrFail($request->code_user);
            $utilisateur->competences()->attach($request->code_comp);

            return response()->json([
                'message' => 'Competence assigned to user successfully',
                'user' => $utilisateur->load('competences')
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to assign competence', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Detach a competence from a user (retirer une compétence)
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'code_user' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);

        try {
            $utilisateur = Utilisateur::findOrFail($request->code_user);
            $utilisateur->competences()->detach($request->code_comp);

            return response()->json([
                'message' => 'Competence removed from user successfully',
                'user' => $utilisateur->load('competences')
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to remove competence', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Lister les compétences d'un utilisateur
     */
    public function userCompetences(string $code_user)
    {
        try {
            $utilisateur = Utilisateur::with('competences')->findOrFail($code_user);
            return response()->json($utilisateur->competences, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user competences', 'message' => $e->getMessage()], 500);
        }
    }
}
