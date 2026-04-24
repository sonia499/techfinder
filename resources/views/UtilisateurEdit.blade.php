@extends('template')

@section('main')
    <main class="flex-grow-1 container mt-4">
        <h1>Modifier l'utilisateur</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.utilisateurs.update', $utilisateur->code_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom_user" class="form-control"
                                   value="{{ $utilisateur->nom_user }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom_user" class="form-control"
                                   value="{{ $utilisateur->prenom_user }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Login</label>
                            <input type="text" name="login_user" class="form-control"
                                   value="{{ $utilisateur->login_user }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password_user" class="form-control">
                            <small class="text-muted">Laisser vide pour ne pas changer</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="tel_user" class="form-control"
                                   value="{{ $utilisateur->tel_user }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sexe</label>
                            <select name="sexe_user" class="form-select" required>
                                <option value="M" {{ $utilisateur->sexe_user == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ $utilisateur->sexe_user == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rôle</label>
                            <select name="role_user" class="form-select" required>
                                <option value="admin" {{ $utilisateur->role_user == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="technicien" {{ $utilisateur->role_user == 'technicien' ? 'selected' : '' }}>Technicien</option>
                                <option value="client" {{ $utilisateur->role_user == 'client' ? 'selected' : '' }}>Client</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">État</label>
                            <select name="etat_user" class="form-select" required>
                                <option value="actif" {{ $utilisateur->etat_user == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ $utilisateur->etat_user == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                <option value="bloque" {{ $utilisateur->etat_user == 'bloque' ? 'selected' : '' }}>Bloqué</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('web.utilisateurs.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </main>
@endsection
