@extends('template')

@section('main')
    <main class="flex-grow-1 container mt-4">
        <h1>Compétences</h1>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulaire d'ajout --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5>Ajouter une compétence</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('web.competences.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" name="label_comp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description_comp" class="form-control" rows="3"></textarea>
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
                    <th>Label</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competences_list as $competence)
                    <tr>
                        <td>{{ $competence->code_comp }}</td>
                        <td>{{ $competence->label_comp }}</td>
                        <td>{{ $competence->description_comp }}</td>
                        <td>
                            {{-- Bouton Modifier --}}
                            <a href="{{ route('web.competences.edit', $competence->code_comp) }}"
                               class="btn btn-warning btn-sm">Modifier</a>

                            {{-- Bouton Supprimer --}}
                            <form action="{{ route('web.competences.destroy', $competence->code_comp) }}"
                                  method="POST" style="display:inline-block"
                                  onsubmit="return confirm('Supprimer cette compétence ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Liens de pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $competences_list->links() }}
        </div>
    </main>
@endsection
