@extends('template')

@section('main')
    <main class="flex-grow-1 container mt-4">
        <h1>Modifier la compétence</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('web.competences.update', $competence->code_comp) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Label</label>
                        <input type="text" name="label_comp" class="form-control"
                               value="{{ $competence->label_comp }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description_comp" class="form-control" rows="3">{{ $competence->description_comp }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="{{ route('web.competences.index') }}" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </main>
@endsection
