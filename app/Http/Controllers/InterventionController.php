<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $interventions = Intervention::with(['client', 'technicien', 'competence'])->get();
            return response()->json($interventions, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve interventions', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_int' => 'required|date',
            'note_int' => 'nullable|integer|min:0|max:20',
            'commentaire_int' => 'nullable|string',
            'code_user_client' => 'required|string|exists:utilisateurs,code_user',
            'code_user_techn' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);

        try {
            $intervention = Intervention::create($request->all());
            $intervention->load(['client', 'technicien', 'competence']);
            return response()->json($intervention, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_int)
    {
        try {
            $intervention = Intervention::with(['client', 'technicien', 'competence'])->findOrFail($code_int);
            return response()->json($intervention, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_int)
    {
        $request->validate([
            'date_int' => 'required|date',
            'note_int' => 'nullable|integer|min:0|max:20',
            'commentaire_int' => 'nullable|string',
            'code_user_client' => 'required|string|exists:utilisateurs,code_user',
            'code_user_techn' => 'required|string|exists:utilisateurs,code_user',
            'code_comp' => 'required|integer|exists:competences,code_comp',
        ]);

        try {
            $intervention = Intervention::findOrFail($code_int);
            $intervention->update($request->all());
            $intervention->load(['client', 'technicien', 'competence']);
            return response()->json($intervention, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update intervention', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_int)
    {
        try {
            $intervention = Intervention::findOrFail($code_int);
            $intervention->delete();
            return response()->json(['message' => 'Intervention deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete intervention', 'message' => $e->getMessage()], 500);
        }
    }
}
