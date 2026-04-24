<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs_list = Utilisateur::paginate(10);
        return view('Utilisateur', compact('utilisateurs_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_user'     => 'required|string|max:255|unique:utilisateurs,code_user',
            'nom_user'      => 'required|string|max:255',
            'prenom_user'   => 'required|string|max:255',
            'login_user'    => 'required|string|max:255',
            'password_user' => 'required|string|max:255',
            'tel_user'      => 'required|string|max:255',
            'sexe_user'     => 'required|string|in:M,F',
            'role_user'     => 'required|string|in:admin,technicien,client',
            'etat_user'     => 'required|string|in:actif,inactif,bloque',
        ]);

        try {
            Utilisateur::create($request->all());
            return redirect()->route('web.utilisateurs.index')
                             ->with('success', 'Utilisateur ajouté avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('web.utilisateurs.index')
                             ->with('error', 'Erreur lors de l\'ajout !');
        }
    }

    public function edit(string $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return view('UtilisateurEdit', compact('utilisateur'));
    }

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'nom_user'      => 'required|string|max:255',
    //         'prenom_user'   => 'required|string|max:255',
    //         'login_user'    => 'required|string|max:255',
    //         'password_user' => 'nullable|string|max:255',
    //         'tel_user'      => 'required|string|max:255',
    //         'sexe_user'     => 'required|string|in:M,F',
    //         'role_user'     => 'required|string|in:admin,technicien,client',
    //         'etat_user'     => 'required|string|in:actif,inactif,bloque',
    //     ]);

    //     try {
    //         $utilisateur = Utilisateur::findOrFail($id);
    //         $utilisateur->update($request->all());
    //         return redirect()->route('web.utilisateurs.index')
    //                          ->with('success', 'Utilisateur modifié avec succès !');
    //     } catch (\Exception $e) {
    //         return redirect()->route('web.utilisateurs.index')
    //                          ->with('error', 'Erreur lors de la modification !');
    //     }
    // }



    public function update(Request $request, string $id)
{
    $request->validate([
        'nom_user'      => 'required|string|max:255',
        'prenom_user'   => 'required|string|max:255',
        'login_user'    => 'required|string|max:255',
        'password_user' => 'nullable|string|max:255',
        'tel_user'      => 'required|string|max:255',
        'sexe_user'     => 'required|string|in:M,F',
        'role_user'     => 'required|string|in:admin,technicien,client',
        'etat_user'     => 'required|string|in:actif,inactif,bloque',
    ]);

    try {
        $utilisateur = Utilisateur::findOrFail($id);
        
        $data = $request->except('password_user');
        
        // Mettre à jour le mot de passe seulement s'il est renseigné
        if ($request->filled('password_user')) {
            $data['password_user'] = bcrypt($request->password_user);
        }
        
        $utilisateur->update($data);
        
        return redirect()->route('web.utilisateurs.index')
                         ->with('success', 'Utilisateur modifié avec succès !');
    } catch (\Exception $e) {
        return redirect()->route('web.utilisateurs.index')
                         ->with('error', 'Erreur : ' . $e->getMessage());
    }
}

    public function destroy(string $id)
    {
        try {
            Utilisateur::findOrFail($id)->delete();
            return redirect()->route('web.utilisateurs.index')
                             ->with('success', 'Utilisateur supprimé avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('web.utilisateurs.index')
                             ->with('error', 'Erreur lors de la suppression !');
        }
    }
}
