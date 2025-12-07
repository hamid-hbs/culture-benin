@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Détails du contenu</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contenus.index') }}" class="text-decoration-none">Contenus</a></li>
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
                    <h5 class="mb-1 fw-semibold text-dark">{{ $contenu->titre ?? '-' }}</h5>
                    <p class="text-muted small mb-0">
                        {{ optional($contenu->typecontenu)->nom ?? '-' }} • 
                        {{ optional($contenu->langue)->nom ?? '-' }} 
                    </p>
                </div>

            </div>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Média principal et statut -->
                <div class="col-md-4">
                    <div class="text-center">
                        @php
                            $featured = $contenu->featured_media_path ?? $contenu->featured_media_url ?? null;
                            $typeName = strtolower(optional($contenu->typecontenu)->nom ?? '');
                        @endphp

                        @if(!empty($featured))
                            <div class="mb-4">
                                @if(\Illuminate\Support\Str::contains($featured, ['.jpg','.jpeg','.png','.gif','.webp']) || \Illuminate\Support\Str::contains($typeName, 'image'))
                                    <img src="{{ asset($featured) }}" 
                                         alt="Média principal" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 250px; object-fit: cover;">
                                @elseif(\Illuminate\Support\Str::contains($featured, ['.mp4','.webm','.ogg']) || \Illuminate\Support\Str::contains($typeName, 'video'))
                                    <video controls class="w-100 rounded shadow-sm" style="max-height: 250px;">
                                        <source src="{{ asset($featured) }}">
                                    </video>
                                @elseif(\Illuminate\Support\Str::contains($featured, ['.mp3','.wav','.ogg']) || \Illuminate\Support\Str::contains($typeName, 'audio'))
                                    <div class="bg-light rounded p-4 shadow-sm">
                                        <audio controls class="w-100">
                                            <source src="{{ asset($featured) }}">
                                        </audio>
                                    </div>
                                @else
                                    <a href="{{ asset($featured) }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="bi bi-download me-2"></i>Télécharger le média
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-4" 
                                 style="height: 200px;">
                                <div class="text-center">
                                    <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2 mb-0">Aucun média principal</p>
                                </div>
                            </div>
                        @endif

                        <!-- Badge de statut -->
                        <div class="mb-4">
                            @if(isset($contenu->statut) && in_array(strtolower($contenu->statut), ['published','publié','actif','active']))
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>Publié
                                </span>
                            @elseif(isset($contenu->statut) && in_array(strtolower($contenu->statut), ['draft','brouillon']))
                                <span class="badge bg-warning rounded-pill px-3 py-2">
                                    <i class="bi bi-pencil-fill me-1"></i>Brouillon
                                </span>
                            @elseif(!empty($contenu->statut))
                                <span class="badge bg-secondary rounded-pill px-3 py-2">
                                    {{ $contenu->statut }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2">
                                    Non défini
                                </span>
                            @endif
                        </div>

                        <!-- Informations rapides -->
                        <div class="bg-light rounded p-3">
                            <h6 class="fw-semibold text-dark mb-3">Informations rapides</h6>
                            
                            <div class="row g-2 text-start">
                                <div class="col-6">
                                    <small class="text-muted">Type</small>
                                    <div class="fw-semibold text-dark">{{ optional($contenu->typecontenu)->nom ?? '-' }}</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Langue</small>
                                    <div class="fw-semibold text-dark">{{ optional($contenu->langue)->nom ?? '-' }}</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Région</small>
                                    <div class="fw-semibold text-dark">{{ optional($contenu->region)->nom ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails du contenu -->
                <div class="col-md-8">
                    <div class="row g-4">
                        <!-- Informations principales -->
                        <div class="col-12">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-info-circle me-2"></i>Informations principales
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Titre</label>
                            <div class="fw-semibold text-dark fs-6">{{ $contenu->titre ?? '-' }}</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Contenu parent</label>
                            <div class="fw-semibold text-dark">
                                @if($contenu->parent)
                                    <a href="{{ route('contenus.show', $contenu->parent->id) }}" class="text-decoration-none">
                                        {{ $contenu->parent->titre }} ({{ $contenu->parent->id }})
                                    </a>
                                @else
                                    <span class="text-muted">Aucun parent</span>
                                @endif
                            </div>
                        </div>

                        <!-- Auteur et Modérateur -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Auteur</label>
                            <div class="d-flex align-items-center">
                                @if($contenu->auteur)
                                    @if(!empty($contenu->auteur->photo))
                                        <img src="{{ asset('storage/' . $contenu->auteur->photo) }}" 
                                             alt="Photo de {{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}" 
                                             class="rounded-circle me-2" 
                                             width="32" 
                                             height="32"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" 
                                             style="width: 32px; height: 32px;">
                                            <i class="bi bi-person text-muted" style="font-size: 0.8rem;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold text-dark">
                                            {{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}
                                        </div>
                                        <a href="mailto:{{ $contenu->auteur->email }}" class="text-muted small text-decoration-none">
                                            {{ $contenu->auteur->email }}
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Modérateur</label>
                            <div class="d-flex align-items-center">
                                @if($contenu->moderateur)
                                    @if(!empty($contenu->moderateur->photo))
                                        <img src="{{ asset('storage/' . $contenu->moderateur->photo) }}" 
                                             alt="Photo de {{ $contenu->moderateur->prenom }} {{ $contenu->moderateur->nom }}" 
                                             class="rounded-circle me-2" 
                                             width="32" 
                                             height="32"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" 
                                             style="width: 32px; height: 32px;">
                                            <i class="bi bi-person text-muted" style="font-size: 0.8rem;"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold text-dark">
                                            {{ $contenu->moderateur->prenom }} {{ $contenu->moderateur->nom }}
                                        </div>
                                        <a href="mailto:{{ $contenu->moderateur->email }}" class="text-muted small text-decoration-none">
                                            {{ $contenu->moderateur->email }}
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted">Non assigné</span>
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
                            <label class="form-label fw-medium text-muted small mb-1">Date de création</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($contenu->date_creation ?? $contenu->created_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Date de validation</label>
                            <div class="fw-semibold text-dark">
                                @if($contenu->date_validation)
                                    {{ $contenu->date_validation->format('d/m/Y à H:i') }}
                                @else
                                    <span class="text-muted">Non validé</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-muted small mb-1">Dernière modification</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($contenu->updated_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>

                        <!-- Contenu texte -->
                        @if($contenu->texte)
                        <div class="col-12 mt-4">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-text-paragraph me-2"></i>Contenu
                            </h6>
                            <div class="bg-light rounded p-4">
                                <div class="text-dark" style="line-height: 1.6;">
                                    {!! nl2br(e($contenu->texte)) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        

                    </div>
                </div>
                <!-- Footer avec boutons -->
        <div class="card-footer d-flex justify-content-between gap-2 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('contenus.index') }}" 
               class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Retour à la liste</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('contenus.edit', $contenu->id) }}" 
                   class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bi bi-pencil"></i>
                    <span>Modifier</span>
                </a>

                <form action="{{ route('contenus.destroy', $contenu->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger d-flex align-items-center gap-2"
                            onclick="return confirm('Supprimer ce contenu ?')">
                        <i class="bi bi-trash"></i>
                        <span>Supprimer</span>
                    </button>
                </form>
            </div>
        </div>


        
            </div>
        </div>

        <!-- Footer avec statistiques -->
        <div class="card-footer bg-transparent border-0 p-4 pt-2">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Créé {{ optional($contenu->created_at)->diffForHumans() ?? '-' }}
                </small>
                
                <div class="d-flex gap-3">
                    @if($contenu->date_validation)
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="bi bi-patch-check-fill me-1"></i>Validé
                        </span>
                    @else
                        <span class="badge bg-warning rounded-pill px-3 py-2">
                            <i class="bi bi-clock me-1"></i>En attente
                        </span>
                    @endif
                </div>
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
        .col-md-4 {
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
            const contentTitle = "{{ $contenu->titre }}";
            return confirm(`Êtes-vous sûr de vouloir supprimer le contenu "${contentTitle}" ? Cette action est irréversible.`);
        };
    });
});
</script>
@endsection