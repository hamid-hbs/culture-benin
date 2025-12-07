@extends('layout')

@section('title')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Modifier le commentaire</h3></div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('commentaires.index') }}">Commentaires</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h5 class="mb-0 fw-semibold">Éditer le commentaire</h5>
                </div>
            </div>

            <form action="{{ route('commentaires.update', $commentaire->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="id_user" class="form-label">Utilisateur (id_user)</label>
                        <select name="id_user" id="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                            @if(!empty($users) && count($users))
                                <option value="">-- Sélectionner --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" {{ (old('id_user', $commentaire->id_user) == $u->id) ? 'selected' : '' }}>
                                        {{ trim(($u->nom ?? '') . ' ' . ($u->prenom ?? '')) ?: ($u->email ?? $u->id) }}
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ old('id_user', $commentaire->id_user) }}">
                                    {{ optional($commentaire->user)->nom ? trim(optional($commentaire->user)->nom . ' ' . optional($commentaire->user)->prenom) : (optional($commentaire->user)->email ?? old('id_user', $commentaire->id_user)) }}
                                </option>
                            @endif
                        </select>
                        @error('id_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_contenu" class="form-label">Contenu</label>
                        <select name="id_contenu" id="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror">
                            @if(!empty($contenus) && count($contenus))
                                <option value="">-- Aucun --</option>
                                @foreach($contenus as $c)
                                    <option value="{{ $c->id }}" {{ (old('id_contenu', $commentaire->id_contenu) == $c->id) ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::limit($c->titre, 60) }}
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ old('id_contenu', $commentaire->id_contenu) }}">
                                    {{ optional($commentaire->contenu)->titre ?? (old('id_contenu', $commentaire->id_contenu) ?? '—') }}
                                </option>
                            @endif
                        </select>
                        @error('id_contenu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="note" class="form-label">Note (0-5)</label>
                        <input type="number" name="note" id="note" min="0" max="5" step="1"
                               class="form-control @error('note') is-invalid @enderror"
                               value="{{ old('note', $commentaire->note) }}">
                        @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="datetime-local" name="date" id="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date', optional($commentaire->date)->format('Y-m-d\TH:i') ?? '') }}">
                        @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label for="texte" class="form-label">Commentaire (texte)</label>
                        <textarea name="texte" id="texte" rows="6" class="form-control @error('texte') is-invalid @enderror" required>{{ old('texte', $commentaire->texte) }}</textarea>
                        @error('texte')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                </div>

                <!-- Footer avec boutons -->
            <div class="card-footer d-flex justify-content-end gap-3 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
                <a href="{{ route('commentaires.index') }}" 
                   class="btn btn-outline-danger d-flex align-items-center gap-2">
                   <i class="bi bi-arrow-left"></i>
                    <span>Annuler</span>
                </a>

                <button type="submit" 
                        class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bi bi-check-lg"></i>
                    <span>Enregistrer les modifications</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .card.border-0.shadow-sm { box-shadow: 0 6px 20px rgba(15,23,42,0.06) !important; border-radius:12px; }
    .form-label { font-size:0.9rem; color:#053061; margin-bottom:0.5rem; font-weight:600; }
    .form-control, .form-select { border:1px solid #e9ecef; border-radius:8px; padding:0.6rem 0.9rem; }
    .form-control:focus, .form-select:focus { box-shadow:0 0 0 0.15rem rgba(13,110,253,0.08); border-color:#4b6ef5; }
    .card-footer .btn { min-width:120px; }
    @media (max-width:576px) {
        .card { margin: 0 12px; }
        .card-footer { flex-direction:column-reverse; gap:0.75rem; }
        .card-footer .btn { width:100%; justify-content:center; }
    }
</style>
