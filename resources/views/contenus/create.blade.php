@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Ajouter un contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contenus.index') }}" class="text-decoration-none">Contenus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        
        <!-- Header avec titre et description -->
        <div class="card-body p-4 pb-2">
            <div class="mb-4">
                <h5 class="mb-1 fw-semibold text-dark">Formulaire d'ajout de contenu</h5>
                <p class="text-muted small mb-0">Remplissez les champs ci-dessous pour créer un nouveau contenu.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('contenus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Titre -->
                    <div class="col-md-8">
                        <label for="titre" class="form-label fw-medium text-dark">
                            Titre<span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="titre" 
                               id="titre" 
                               class="form-control @error('titre') is-invalid @enderror" 
                               placeholder="Ex: Introduction à l'agriculture durable"
                               value="{{ old('titre') }}" 
                               required>
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type de contenu -->
                    <div class="col-md-4">
                        <label for="id_type_contenu" class="form-label fw-medium text-dark">
                            Type de contenu<span class="text-danger">*</span>
                        </label>
                        <select name="id_type_contenu" 
                                id="id_type_contenu" 
                                class="form-select @error('id_type_contenu') is-invalid @enderror" 
                                required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($typecontenus ?? [] as $type)
                                <option value="{{ $type->id }}" {{ old('id_type_contenu') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_type_contenu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Texte du contenu -->
                    <div class="col-12">
                        <label for="texte" class="form-label fw-medium text-dark">
                            Contenu<span class="text-danger">*</span>
                        </label>
                        <textarea name="texte" 
                                  id="texte" 
                                  rows="8" 
                                  class="form-control @error('texte') is-invalid @enderror" 
                                  placeholder="Saisissez le contenu principal..."
                                  required>{{ old('texte') }}</textarea>
                        @error('texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Vous pouvez utiliser la mise en forme de base ou intégrer un éditeur WYSIWYG.</div>
                    </div>

                    <!-- Langue et Région -->
                    <div class="col-md-6">
                        <label for="id_langue" class="form-label fw-medium text-dark">Langue<span class="text-danger">*</span></label>
                        <select name="id_langue" 
                                id="id_langue" 
                                class="form-select @error('id_langue') is-invalid @enderror">
                            <option value="">-- Sélectionner --</option>
                            @foreach($langues ?? [] as $langue)
                                <option value="{{ $langue->id }}" {{ old('id_langue') == $langue->id ? 'selected' : '' }}>
                                    {{ $langue->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_langue')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_region" class="form-label fw-medium text-dark">Région<span class="text-danger">*</span></label>
                        <select name="id_region" 
                                id="id_region" 
                                class="form-select @error('id_region') is-invalid @enderror">
                            <option value="">-- Sélectionner --</option>
                            @foreach($regions ?? [] as $region)
                                <option value="{{ $region->id }}" {{ old('id_region') == $region->id ? 'selected' : '' }}>
                                    {{ $region->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_region')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Auteur et Modérateur -->
                    <div class="col-md-6">
                        <label for="id_auteur" class="form-label fw-medium text-dark">
                            Auteur<span class="text-danger">*</span>
                        </label>
                        <select name="id_auteur" 
                                id="id_auteur" 
                                class="form-select @error('id_auteur') is-invalid @enderror" 
                                required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($auteurs ?? [] as $auteur)
                                <option value="{{ $auteur->id }}" {{ old('id_auteur') == $auteur->id ? 'selected' : '' }}>
                                    {{ trim(($auteur->nom ?? '') . ' ' . ($auteur->prenom ?? '')) ?: $auteur->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_auteur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="id_moderateur" class="form-label fw-medium text-dark">Modérateur</label>
                        <select name="id_moderateur" 
                                id="id_moderateur" 
                                class="form-select @error('id_moderateur') is-invalid @enderror">
                            <option value="">-- Sélectionner --</option>
                            @foreach($moderateurs ?? [] as $moderateur)
                                <option value="{{ $moderateur->id }}" {{ old('id_moderateur') == $moderateur->id ? 'selected' : '' }}>
                                    {{ trim(($moderateur->nom ?? '') . ' ' . ($moderateur->prenom ?? '')) ?: $moderateur->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_moderateur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Parent et Dates -->
                    <div class="col-md-6">
                        <label for="parent_id" class="form-label fw-medium text-dark">Contenu parent</label>
                        <select name="parent_id" 
                                id="parent_id" 
                                class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">-- Aucun parent --</option>
                            @foreach($contenusParents ?? [] as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->titre }} ({{ $parent->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date_creation" class="form-label fw-medium text-dark">Date de création</label>
                        <input type="datetime-local" 
                               name="date_creation" 
                               id="date_creation"
                               class="form-control @error('date_creation') is-invalid @enderror" 
                               value="{{ old('date_creation') ?? now()->format('Y-m-d\TH:i') }}">
                        @error('date_creation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut et Date de validation -->
                    <div class="col-md-6">
                        <label for="statut" class="form-label fw-medium text-dark">Statut</label>
                        <select name="statut" 
                                id="statut" 
                                class="form-select @error('statut') is-invalid @enderror">
                            <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="publié" {{ old('statut') == 'publié' ? 'selected' : '' }}>Publié</option>
                            <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="archivé" {{ old('statut') == 'archivé' ? 'selected' : '' }}>Archivé</option>
                        </select>
                        @error('statut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date_validation" class="form-label fw-medium text-dark">Date de validation</label>
                        <input type="datetime-local" 
                               name="date_validation" 
                               id="date_validation"
                               class="form-control @error('date_validation') is-invalid @enderror" 
                               value="{{ old('date_validation') }}">
                        @error('date_validation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Laisser vide si non validé</div>
                    </div>

                    <!-- Fichiers multimédias -->
                    <div class="col-12">
                        <label for="media_files" class="form-label fw-medium text-dark">Fichiers multimédias</label>
                        <input type="file" 
                               name="media_files[]" 
                               id="media_files"
                               class="form-control @error('media_files') is-invalid @enderror" 
                               accept="image/*,video/*,audio/*,.pdf,.doc,.docx"
                               multiple>
                        @error('media_files')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Formats acceptés : images, vidéos, audio, PDF, Word. Taille max : 10MB par fichier.</div>
                    </div>

                </div>

        </div>

        <!-- Footer avec boutons -->
        <div class="card-footer d-flex justify-content-end gap-3 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('contenus.index') }}" 
               class="btn btn-outline-danger d-flex align-items-center gap-2">
               <i class="bi bi-arrow-left"></i>
                <span>Annuler</span>
            </a>

            <button type="submit" 
                    class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-check-lg"></i>
                <span>Enregistrer</span>
            </button>
        </div>
        </form>

    </div>
</div>

<style>
    /* Style global pour la carte du formulaire */
    .card.border-0.shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        transition: box-shadow 0.15s ease-in-out;
    }
    .card.border-0.shadow-sm:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Labels et champs de formulaire */
    .form-label {
        font-size: 0.9rem;
        color: #053061;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        background-color: #fbfdff;
    }
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    /* Zone de métadonnées */
    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* Boutons du footer */
    .btn {
        font-weight: 500;
        transition: all 0.15s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Icônes dans les boutons */
    .btn i {
        font-size: 1rem;
    }

    /* Responsive pour mobile */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .card-footer {
            flex-direction: column-reverse;
            gap: 1rem;
        }
        .btn {
            justify-content: center;
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-remplissage de la date de création avec la date actuelle
    const dateCreationField = document.getElementById('date_creation');
    if (dateCreationField && !dateCreationField.value) {
        dateCreationField.value = new Date().toISOString().slice(0, 16);
    }

    // Gestion de l'affichage conditionnel pour la date de validation
    const statutField = document.getElementById('statut');
    const dateValidationField = document.getElementById('date_validation');
    
    if (statutField && dateValidationField) {
        statutField.addEventListener('change', function() {
            if (this.value === 'publié' && !dateValidationField.value) {
                dateValidationField.value = new Date().toISOString().slice(0, 16);
            }
        });
    }

    // Compteur de caractères pour le texte
    const texteField = document.getElementById('texte');
    if (texteField) {
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        counter.textContent = `${texteField.value.length} caractères`;
        
        texteField.parentNode.appendChild(counter);
        
        texteField.addEventListener('input', function() {
            counter.textContent = `${this.value.length} caractères`;
        });
    }
});
</script>

@endsection