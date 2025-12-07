@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Détails du média</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('medias.index') }}" class="text-decoration-none">Médias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Détails</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        
        <!-- Header avec actions -->
        <div class="card-header bg-transparent border-0 p-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1 fw-semibold text-dark"> {{ basename($media->chemin) }}</h5>
                    <p class="text-muted small mb-0">
                        {{ optional($media->type_media)->nom ?? 'Type inconnu' }} • 
                        {{ optional($media->contenu)->titre ? 'Associé à un contenu' : 'Non associé' }}
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Aperçu du média -->
                <div class="col-md-5">
                    <div class="text-center">
                        @php
                            $chemin = $media->chemin;
                            $isImage = \Illuminate\Support\Str::contains($chemin, ['.jpg','.jpeg','.png','.gif','.webp','.bmp']);
                            $isVideo = \Illuminate\Support\Str::contains($chemin, ['.mp4','.webm','.ogg','.mov']);
                            $isAudio = \Illuminate\Support\Str::contains($chemin, ['.mp3','.wav','.ogg','.m4a']);
                        @endphp

                        @if(!empty($chemin))
                            <div class="mb-4">
                                @if($isImage)
                                    <img src="{{ asset('storage/' . $chemin) }}"
                                         alt="Aperçu du média" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 300px; object-fit: contain;"
                                         onerror="this.style.display='none'; document.getElementById('media-fallback').style.display='block';">
                                @elseif($isVideo)
                                    <video controls class="w-100 rounded shadow-sm" style="max-height: 300px;">
                                        <source src="{{ asset('storage/' . $chemin) }}">
                                        Votre navigateur ne supporte pas la lecture vidéo.
                                    </video>
                                @elseif($isAudio)
                                    <div class="bg-primary bg-opacity-10 rounded p-4 shadow-sm">
                                        <audio controls class="w-100">
                                            <source src="{{ asset('storage/' . $chemin) }}">
                                            Votre navigateur ne supporte pas la lecture audio.
                                        </audio>
                                    </div>
                                @else
                                    <div class="bg-secondary bg-opacity-10 rounded p-4 shadow-sm text-center">
                                        <i class="bi bi-file-earmark-text display-4 text-secondary mb-3"></i>
                                        <p class="text-secondary mb-2">Type de fichier non prévisualisable</p>
                                        <a href="{{ asset('storage/' . $chemin) }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="bi bi-download me-1"></i>Télécharger
                                        </a>
                                    </div>
                                @endif
                                
                                <!-- Fallback pour les médias qui ne se chargent pas -->
                                <div id="media-fallback" class="text-center" style="display: none;">
                                    <div class="bg-light rounded p-4 shadow-sm">
                                        <i class="bi bi-file-earmark-x display-4 text-muted mb-3"></i>
                                        <p class="text-muted mb-2">Impossible de charger l'aperçu</p>
                                        <a href="{{ asset('storage/' . $chemin) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-download me-1"></i>Télécharger le fichier
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-light rounded p-4 mb-4">
                                <i class="bi bi-file-earmark-x display-4 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">Aucun fichier associé</p>
                            </div>
                        @endif

                        <!-- Informations rapides -->
                        <div class="bg-light rounded p-3">
                            <h6 class="fw-semibold text-dark mb-3">Informations rapides</h6>
                            
                            <div class="row g-2 text-start">
                                <div class="col-6">
                                    <small class="text-muted">Type</small>
                                    <div class="fw-semibold text-dark">{{ optional($media->type_media)->nom ?? '-' }}</div>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">Chemin</small>
                                    <div class="fw-semibold text-dark small text-truncate" title="{{ $media->chemin }}">
                                        {{ $media->chemin }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails du média -->
                <div class="col-md-7">
                    <div class="row g-4">
                        <!-- Informations principales -->
                        <div class="col-12">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-info-circle me-2"></i>Informations principales
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium text-muted small mb-1">Description</label>
                            <div class="bg-light rounded p-3">
                                @if($media->description)
                                    <p class="mb-0 text-dark" style="line-height: 1.6;">{{ $media->description }}</p>
                                @else
                                    <p class="mb-0 text-muted">Aucune description</p>
                                @endif
                            </div>
                        </div>

                        <!-- Relations -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-link-45deg me-2"></i>Relations
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Contenu associé</label>
                            <div class="fw-semibold text-dark">
                                @if($media->contenu)
                                    <a href="{{ route('contenus.show', $media->contenu->id) }}" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text text-primary me-2"></i>
                                            <div>
                                                <div>{{ $media->contenu->titre }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-muted">Aucun contenu associé</span>
                                @endif
                            </div>
                        </div>
                             

                        <!-- Dates -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-clock me-2"></i>Dates importantes
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Créé le</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($media->created_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Mis à jour le</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($media->updated_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer avec actions -->
        <div class="card-footer d-flex justify-content-between gap-2 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('medias.index') }}" 
               class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Retour à la liste</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('medias.edit', $media->id) }}" 
                   class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bi bi-pencil"></i>
                    <span>Modifier</span>
                </a>

                <form action="{{ route('medias.destroy', $media->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger d-flex align-items-center gap-2"
                            onclick="return confirm('Supprimer ce média ?')">
                        <i class="bi bi-trash"></i>
                        <span>Supprimer</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card.border-0.shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        transition: box-shadow 0.15s ease-in-out;
    }
    .card.border-0.shadow-sm:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .btn {
        font-weight: 500;
        transition: all 0.15s ease-in-out;
        border-radius: 8px;
    }
    .btn:hover {
        transform: translateY(-1px);
    }

    .border-bottom {
        border-color: #e9ecef !important;
    }

    .badge {
        font-size: 0.75rem;
    }

    .badge.rounded-pill {
        border-radius: 50rem !important;
    }

    .form-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-header .btn-group {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
        }
        .card-header .btn-group .btn {
            width: 100%;
            justify-content: center;
        }
        .card-header .btn-group form {
            width: 100%;
        }
        .card-header .btn-group form .btn {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .col-md-5 {
            margin-bottom: 2rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des badges au survol
    const badges = document.querySelectorAll('.badge');
    badges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.2s ease';
        });
        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Confirmation de suppression avec message personnalisé
    const deleteForms = document.querySelectorAll('form[onsubmit]');
    deleteForms.forEach(form => {
        form.onsubmit = function(e) {
            const fileName = "{{ basename($media->chemin) }}";
            return confirm(`Êtes-vous sûr de vouloir supprimer le média "${fileName}" ? Cette action est irréversible.`);
        };
    });

    // Gestion des erreurs de chargement des médias
    const mediaImage = document.querySelector('img[onerror]');
    if (mediaImage) {
        mediaImage.addEventListener('error', function() {
            this.style.display = 'none';
            const fallback = document.getElementById('media-fallback');
            if (fallback) {
                fallback.style.display = 'block';
            }
        });
    }
});
</script>
@endsection