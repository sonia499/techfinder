<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index()
    {
        $competences_list = Competence::paginate(10);
        return view('Competence', compact('competences_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label_comp'       => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);

        try {
            Competence::create([
                'label_comp'       => $request->label_comp,
                'description_comp' => $request->description_comp,
            ]);

            return redirect()->route('web.competences.index')
                         ->with('success', 'Compétence ajoutée avec succès !');

        } catch (\Exception $e) {
            return redirect()->route('web.competences.index')
                         ->with('error', 'Erreur lors de l\'ajout !'); // ✅ Toast rouge
        }
    }

    public function edit(string $id)
    {
        $competence = Competence::findOrFail($id);
        return view('CompetenceEdit', compact('competence'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'label_comp'       => 'required|string|max:255',
            'description_comp' => 'nullable|string',
        ]);

        $competence = Competence::findOrFail($id);
        $competence->update([
            'label_comp'       => $request->label_comp,
            'description_comp' => $request->description_comp,
        ]);

        return redirect()->route('web.competences.index')
                         ->with('success', 'Compétence modifiée avec succès !');
    }

    public function destroy(string $id)
    {
        Competence::findOrFail($id)->delete();

        return redirect()->route('web.competences.index')
                         ->with('success', 'Compétence supprimée avec succès !');
    }
}
