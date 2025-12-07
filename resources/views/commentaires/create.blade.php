@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Ajouter un commentaire</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('commentaires.index') }}" class="text-decoration-none">Commentaires</a></li>
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
                <h5 class="mb-1 fw-semibold text-dark">Formulaire d'ajout de commentaire</h5>
                <p class="text-muted small mb-0">Remplissez les champs ci-dessous pour créer un nouveau commentaire.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('commentaires.store') }}" method="POST" id="commentaire-form">
                @csrf

                <div class="row g-3">
                    <!-- Utilisateur -->
                    <div class="col-md-6">
                        <label for="id_user" class="form-label fw-medium text-dark">
                            Utilisateur<span class="text-danger">*</span>
                        </label>
                        <select name="id_user" 
                                id="id_user" 
                                class="form-select @error('id_user') is-invalid @enderror" 
                                required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->prenom }} {{ $user->nom }} ({{ $user->email }})
                                    @if($user->role)
                                        - {{ $user->role->nom }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(($users ?? [])->isEmpty())
                            <div class="form-text text-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                Aucun utilisateur trouvé.
                            </div>
                        @endif
                    </div>

                    <!-- Contenu associé -->
                    <div class="col-md-6">
                        <label for="id_contenu" class="form-label fw-medium text-dark">
                            Contenu associé<span class="text-danger">*</span>
                        </label>
                        <select name="id_contenu" 
                                id="id_contenu" 
                                class="form-select @error('id_contenu') is-invalid @enderror" 
                                required>
                            <option value="">-- Sélectionner un contenu --</option>
                            @foreach($contenus ?? [] as $contenu)
                                <option value="{{ $contenu->id }}" {{ old('id_contenu') == $contenu->id ? 'selected' : '' }}>
                                    {{ $contenu->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_contenu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(($contenus ?? [])->isEmpty())
                            <div class="form-text text-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                Aucun contenu trouvé.
                            </div>
                        @endif
                    </div>

                    <!-- Note -->
                    <div class="col-md-6">
                        <label for="note" class="form-label fw-medium text-dark">Note</label>
                        <div class="d-flex align-items-center gap-2">
                            <select name="note" 
                                    id="note" 
                                    class="form-select @error('note') is-invalid @enderror">
                                <option value="">-- Aucune note --</option>
                                @for($i = 0; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('note') == $i ? 'selected' : '' }}>
                                        {{ $i }} étoile{{ $i > 0 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            <div id="note-preview" class="d-none">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ old('note') && $i <= old('note') ? '-fill' : '' }} text-warning" 
                                       style="font-size: 1.2rem;"></i>
                                @endfor
                            </div>
                        </div>
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label for="date" class="form-label fw-medium text-dark">Date</label>
                        <input type="datetime-local" 
                               name="date" 
                               id="date"
                               class="form-control @error('date') is-invalid @enderror" 
                               value="{{ old('date') ?? now()->format('Y-m-d\TH:i') }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">La date du commentaire</div>
                    </div>

                    <!-- Texte du commentaire -->
                    <div class="col-12">
                        <label for="texte" class="form-label fw-medium text-dark">
                            Commentaire<span class="text-danger">*</span>
                        </label>
                        <textarea name="texte" 
                                  id="texte" 
                                  rows="6" 
                                  class="form-control @error('texte') is-invalid @enderror" 
                                  placeholder="Saisissez votre commentaire..."
                                  maxlength="1000"
                                  required>{{ old('texte') }}</textarea>
                        @error('texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-end">
                            <span id="texte-counter">0</span>/1000 caractères
                        </div>
                    </div>

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
                    class="btn btn-primary d-flex align-items-center gap-2"
                    id="submit-btn">
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

    /* Prévisualisation des notes */
    #note-preview {
        margin-left: 10px;
    }

    .bi-star-fill {
        color: #ffc107;
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
        .d-flex.align-items-center.gap-2 {
            flex-direction: column;
            align-items: flex-start;
        }
        #note-preview {
            margin-left: 0;
            margin-top: 10px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Compteur de caractères pour le texte
    const texteField = document.getElementById('texte');
    const texteCounter = document.getElementById('texte-counter');
    
    if (texteField && texteCounter) {
        texteCounter.textContent = texteField.value.length;
        
        texteField.addEventListener('input', function() {
            texteCounter.textContent = this.value.length;
            
            if (this.value.length > 800) {
                texteCounter.classList.add('text-warning');
            } else {
                texteCounter.classList.remove('text-warning');
            }
            
            if (this.value.length >= 1000) {
                texteCounter.classList.add('text-danger');
            } else {
                texteCounter.classList.remove('text-danger');
            }
        });
    }

    // Prévisualisation des notes
    const noteSelect = document.getElementById('note');
    const notePreview = document.getElementById('note-preview');
    
    if (noteSelect && notePreview) {
        noteSelect.addEventListener('change', function() {
            const selectedNote = parseInt(this.value);
            
            if (selectedNote) {
                notePreview.classList.remove('d-none');
                notePreview.innerHTML = '';
                
                for (let i = 1; i <= 5; i++) {
                    const star = document.createElement('i');
                    star.className = `bi bi-star${i <= selectedNote ? '-fill' : ''} text-warning`;
                    star.style.fontSize = '1.2rem';
                    notePreview.appendChild(star);
                }
            } else {
                notePreview.classList.add('d-none');
            }
        });
        
        // Initialiser la prévisualisation si une valeur existe déjà
        if (noteSelect.value) {
            noteSelect.dispatchEvent(new Event('change'));
        }
    }

    // Validation du formulaire avant soumission
    const form = document.getElementById('commentaire-form');
    const submitBtn = document.getElementById('submit-btn');
    
    form.addEventListener('submit', function(e) {
        const texteField = document.getElementById('texte');
        
        // Vérification de la longueur du texte
        if (texteField.value.trim().length < 5) {
            e.preventDefault();
            alert('Le commentaire doit contenir au moins 5 caractères.');
            texteField.focus();
            return;
        }
        
        if (texteField.value.length > 1000) {
            e.preventDefault();
            alert('Le commentaire ne peut pas dépasser 1000 caractères.');
            texteField.focus();
            return;
        }
        
        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i><span>Enregistrement en cours...</span>';
    });

    
});
</script>

@endsection