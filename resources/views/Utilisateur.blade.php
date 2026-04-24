@extends('template')

@section('main')
    <main class="flex-grow-1 container mt-4">
        <h1>Utilisateurs</h1>

        {{-- Formulaire d'ajout --}}
        <div class="card mb-4">
            <div class="card-header"><h5>Ajouter un utilisateur</h5></div>
            <div class="card-body">
                <form action="{{ route('web.utilisateurs.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" name="code_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Login</label>
                            <input type="text" name="login_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="tel_user" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sexe</label>
                            <select name="sexe_user" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rôle</label>
                            <select name="role_user" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                <option value="admin">Admin</option>
                                <option value="technicien">Technicien</option>
                                <option value="client">Client</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">État</label>
                            <select name="etat_user" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                                <option value="bloque">Bloqué</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>

        {{-- Tableau --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Téléphone</th>
                    <th>Sexe</th>
                    <th>Rôle</th>
                    <th>État</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utilisateurs_list as $utilisateur)
                    <tr>
                        <td>{{ $utilisateur->code_user }}</td>
                        <td>{{ $utilisateur->nom_user }}</td>
                        <td>{{ $utilisateur->prenom_user }}</td>
                        <td>{{ $utilisateur->login_user }}</td>
                        <td>{{ $utilisateur->tel_user }}</td>
                        <td>{{ $utilisateur->sexe_user }}</td>
                        <td>{{ $utilisateur->role_user }}</td>
                        <td>{{ $utilisateur->etat_user }}</td>
                        <td>
                            <a href="{{ route('web.utilisateurs.edit', $utilisateur->code_user) }}"
                               class="btn btn-warning btn-sm">Modifier</a>

                            <form action="{{ route('web.utilisateurs.destroy', $utilisateur->code_user) }}"
                                  method="POST" style="display:inline-block"
                                  onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $utilisateurs_list->links() }}
        </div>
    </main>
@endsection
