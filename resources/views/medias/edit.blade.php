@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Modifier un média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('medias.index') }}" class="text-decoration-none">Médias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier</li>
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
                <h5 class="mb-1 fw-semibold text-dark">Modification du média</h5>
                <p class="text-muted small mb-0">Modifiez les champs ci-dessous pour mettre à jour le média.</p>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <span class="badge bg-light text-dark rounded-pill px-3 py-1">
                        <i class="bi bi-calendar me-1"></i>
                        Créé le : {{ optional($media->created_at)->format('d/m/Y à H:i') ?? '-' }}
                    </span>
                    @if($media->updated_at && $media->updated_at->ne($media->created_at))
                    <span class="badge bg-light text-dark rounded-pill px-3 py-1">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        Modifié le : {{ $media->updated_at->format('d/m/Y à H:i') }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('medias.update', $media->id) }}" method="POST" enctype="multipart/form-data" id="media-form">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Chemin du fichier - Modification -->
                    <div class="col-md-6">
                        <label for="chemin" class="form-label fw-medium text-dark">Remplacer le fichier</label>
                        <input type="file" 
                               name="chemin" 
                               id="chemin" 
                               class="form-control @error('chemin') is-invalid @enderror" 
                               accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.zip"
                               onchange="previewFile(this)">
                        @error('chemin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Laisser vide pour conserver le fichier actuel. Taille max : 10MB.</div>
                    </div>

                    <!-- Type de média -->
                    <div class="col-md-6">
                        <label for="id_type_media" class="form-label fw-medium text-dark">
                            Type de média<span class="text-danger">*</span>
                        </label>
                        <select name="id_type_media" 
                                id="id_type_media" 
                                class="form-select @error('id_type_media') is-invalid @enderror" 
                                required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($typemedias ?? [] as $type)
                                <option value="{{ $type->id }}" {{ old('id_type_media', $media->id_type_media) == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_type_media')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fichier actuel -->
                    <div class="col-12">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-semibold text-dark mb-3">Fichier actuel</h6>
                            
                            @php
                                $chemin = $media->chemin;
                                $isImage = \Illuminate\Support\Str::contains($chemin, ['.jpg','.jpeg','.png','.gif','.webp','.bmp']);
                                $isVideo = \Illuminate\Support\Str::contains($chemin, ['.mp4','.webm','.ogg','.mov']);
                                $isAudio = \Illuminate\Support\Str::contains($chemin, ['.mp3','.wav','.ogg','.m4a']);
                            @endphp

                            @if(!empty($chemin))
                                <div class="text-center">
                                    @if($isImage)
                                        <img src="{{ asset('storage/'.$chemin) }}" 
                                             alt="Média actuel" 
                                             class="img-fluid rounded shadow-sm mb-3" 
                                             style="max-height: 250px; object-fit: cover;"
                                             onerror="this.style.display='none'; document.getElementById('file-fallback').style.display='block';">
                                    @elseif($isVideo)
                                        <video controls class="w-100 rounded shadow-sm mb-3" style="max-height: 250px;">
                                            <source src="{{ asset('storage/'.$chemin) }}">
                                            Votre navigateur ne supporte pas la lecture vidéo.
                                        </video>
                                    @elseif($isAudio)
                                        <div class="bg-primary bg-opacity-10 rounded p-4 mb-3">
                                            <audio controls class="w-100">
                                                <source src="{{ asset('storage/'.$chemin) }}">
                                                Votre navigateur ne supporte pas la lecture audio.
                                            </audio>
                                        </div>
                                    @endif
                                    
                                    <!-- Fallback pour les images qui ne se chargent pas -->
                                    <div id="file-fallback" class="text-center" style="display: none;">
                                        <div class="bg-light rounded p-4 mb-3">
                                            <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                                            <p class="mt-2 text-muted">Impossible de charger l'aperçu</p>
                                        </div>
                                    </div>

                                    <div class="text-muted small">
                                        <strong>Chemin :</strong> {{ $chemin }}<br>
                                        <strong>Nom du fichier :</strong> {{ basename($chemin) }}
                                    </div>
                                </div>
                            @else
                                <div class="text-center text-muted">
                                    <i class="bi bi-file-earmark-x display-4"></i>
                                    <p class="mt-2 mb-0">Aucun fichier associé</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-medium text-dark">Description</label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Décrivez le contenu de ce média..."
                                  maxlength="500">{{ old('description', $media->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-end">
                            <span id="description-counter">{{ strlen(old('description', $media->description)) }}</span>/500 caractères
                        </div>
                    </div>

                    <!-- Contenu lié -->
                    <div class="col-md-6">
                        <label for="id_contenu" class="form-label fw-medium text-dark">Contenu associé</label>
                        <select name="id_contenu" 
                                id="id_contenu" 
                                class="form-select @error('id_contenu') is-invalid @enderror">
                            <option value="">-- Aucun contenu associé --</option>
                            @foreach($contenus ?? [] as $contenu)
                                <option value="{{ $contenu->id }}" {{ old('id_contenu', $media->id_contenu) == $contenu->id ? 'selected' : '' }}>
                                    {{ $contenu->titre }} ({{ $contenu->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_contenu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lier ce média à un contenu existant</div>
                    </div>


                    <!-- Prévisualisation du nouveau fichier -->
                    <div class="col-12">
                        <div id="file-preview" class="text-center" style="display: none;">
                            <h6 class="fw-semibold text-dark mb-3">Aperçu du nouveau fichier</h6>
                            <div class="border rounded p-4 bg-light">
                                <div id="preview-content"></div>
                                <div class="mt-3">
                                    <small class="text-muted" id="file-info"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        </div>

        <!-- Footer avec boutons -->
        <div class="card-footer d-flex justify-content-end gap-3 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('medias.index') }}" 
               class="btn btn-outline-danger d-flex align-items-center gap-2">
               <i class="bi bi-arrow-left"></i>
                <span>Annuler</span>
            </a>

            <button type="submit" 
                    class="btn btn-primary d-flex align-items-center gap-2"
                    id="submit-btn">
                <i class="bi bi-check-lg"></i>
                <span>Mettre à jour</span>
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

    /* Prévisualisation */
    #preview-content img, #preview-content video, #preview-content audio {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
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

    /* Badges d'information */
    .badge.bg-light {
        border: 1px solid #dee2e6;
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
    // Compteur de caractères pour la description
    const descriptionField = document.getElementById('description');
    const descriptionCounter = document.getElementById('description-counter');
    
    if (descriptionField && descriptionCounter) {
        descriptionField.addEventListener('input', function() {
            descriptionCounter.textContent = this.value.length;
            
            if (this.value.length > 450) {
                descriptionCounter.classList.add('text-warning');
            } else {
                descriptionCounter.classList.remove('text-warning');
            }
            
            if (this.value.length >= 500) {
                descriptionCounter.classList.add('text-danger');
            } else {
                descriptionCounter.classList.remove('text-danger');
            }
        });
    }

    // Prévisualisation du nouveau fichier
    window.previewFile = function(input) {
        const preview = document.getElementById('file-preview');
        const previewContent = document.getElementById('preview-content');
        const fileInfo = document.getElementById('file-info');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Taille en MB
            
            // Vérification de la taille du fichier
            if (file.size > 10 * 1024 * 1024) {
                alert(' Le fichier est trop volumineux. Taille maximale : 10MB.');
                input.value = '';
                preview.style.display = 'none';
                return;
            }
            
            // Affichage des informations du fichier
            fileInfo.textContent = `Nom: ${file.name} | Taille: ${fileSize} MB | Type: ${file.type}`;
            
            // Prévisualisation selon le type de fichier
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `<img src="${e.target.result}" alt="Aperçu du nouveau fichier" class="img-fluid rounded shadow-sm">`;
                };
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `
                        <video controls class="w-100 rounded shadow-sm">
                            <source src="${e.target.result}" type="${file.type}">
                            Votre navigateur ne supporte pas la lecture vidéo.
                        </video>
                    `;
                };
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('audio/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `
                        <div class="bg-primary bg-opacity-10 rounded p-4">
                            <audio controls class="w-100">
                                <source src="${e.target.result}" type="${file.type}">
                                Votre navigateur ne supporte pas la lecture audio.
                            </audio>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                previewContent.innerHTML = `
                    <div class="text-center">
                        <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                        <p class="mt-2 text-muted">Aperçu non disponible pour ce type de fichier</p>
                    </div>
                `;
            }
            
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    };

    // Validation du formulaire avant soumission
    const form = document.getElementById('media-form');
    const submitBtn = document.getElementById('submit-btn');
    
    form.addEventListener('submit', function(e) {
        const fileInput = document.getElementById('chemin');
        
        // Vérification de la taille du fichier si un nouveau fichier est sélectionné
        if (fileInput.files && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            if (file.size > 10 * 1024 * 1024) {
                e.preventDefault();
                alert(' Le fichier est trop volumineux. Taille maximale : 10MB.');
                fileInput.focus();
                return;
            }
        }
        
        // Désactiver le bouton pour éviter les doubles clics
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i><span>Mise à jour en cours...</span>';
    });

    // Adaptation des types de fichiers acceptés selon le type de média sélectionné
    const typeMediaSelect = document.getElementById('id_type_media');
    const fileInput = document.getElementById('chemin');
    
    if (typeMediaSelect && fileInput) {
        typeMediaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const typeName = selectedOption.text.toLowerCase();
            
            if (typeName.includes('image')) {
                fileInput.setAttribute('accept', 'image/*');
                fileInput.nextElementSibling.textContent = 'Formats acceptés : JPG, PNG, GIF, WebP. Taille max : 10MB.';
            } else if (typeName.includes('video')) {
                fileInput.setAttribute('accept', 'video/*');
                fileInput.nextElementSibling.textContent = 'Formats acceptés : MP4, WebM, OGG. Taille max : 10MB.';
            } else if (typeName.includes('audio')) {
                fileInput.setAttribute('accept', 'audio/*');
                fileInput.nextElementSibling.textContent = 'Formats acceptés : MP3, WAV, OGG. Taille max : 10MB.';
            } else {
                fileInput.setAttribute('accept', 'image/*,video/*,audio/*,.pdf,.doc,.docx,.zip');
                fileInput.nextElementSibling.textContent = 'Formats acceptés : images, vidéos, audio, documents. Taille max : 10MB.';
            }
        });
    }
});
</script>

@endsection