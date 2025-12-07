@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Détails du commentaire</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('commentaires.index') }}" class="text-decoration-none">Commentaires</a></li>
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
                    <h5 class="mb-1 fw-semibold text-dark">Commentaire #{{ $commentaire->id }}</h5>
                    <p class="text-muted small mb-0">
                        @if($commentaire->user)
                            {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}
                        @else
                            Utilisateur inconnu
                        @endif
                        • 
                        {{ optional($commentaire->date ?? $commentaire->created_at)->format('d/m/Y à H:i') ?? '-' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- Avatar et note centrés en haut -->
            <div class="text-center mb-5">
                <!-- Avatar utilisateur -->
                <div class="mb-4">
                    @if($commentaire->user && !empty($commentaire->user->photo))
                        <img src="{{ asset('storage/' . $commentaire->user->photo) }}" 
                             alt="Photo de {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}" 
                             class="rounded-circle shadow-sm" 
                             width="140" 
                             height="140"
                             style="object-fit: cover; border: 4px solid #fff;">
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" 
                             style="width: 140px; height: 140px; border: 4px solid #fff;">
                            <i class="bi bi-person text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                </div>

                <!-- Note -->
                @if($commentaire->note !== null)
                    <div class="d-flex align-items-center justify-content-center gap-1 mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $commentaire->note)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span class="fw-bold text-dark ms-2">{{ $commentaire->note }}/5</span>
                    </div>
                @else
                    <div class="text-muted mb-3">Aucune note attribuée</div>
                @endif
            </div>

            <!-- Détails du commentaire -->
            <div class="row g-3">
                <!-- Informations principales -->
                <div class="col-12">
                    <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                        <i class="bi bi-info-circle me-2"></i>Informations principales
                    </h6>
                </div>

                <!-- Utilisateur -->
                <div class="col-md-6">
                    <label class="form-label fw-medium text-muted small mb-1">Utilisateur</label>
                    <div class="d-flex align-items-center">
                        @if($commentaire->user)
                            @if(!empty($commentaire->user->photo))
                                <img src="{{ asset('storage/' . $commentaire->user->photo) }}" 
                                     alt="Photo de {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}" 
                                     class="rounded-circle me-2" 
                                     width="40" 
                                     height="40"
                                     style="object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" 
                                     style="width: 40px; height: 40px;">
                                    <i class="bi bi-person text-muted" style="font-size: 1rem;"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-semibold text-dark">
                                    {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}
                                </div>
                                <a href="mailto:{{ $commentaire->user->email }}" class="text-muted small text-decoration-none">
                                    {{ $commentaire->user->email }}
                                </a>
                                @if($commentaire->user->role)
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        {{ $commentaire->user->role->nom }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <span class="text-muted">Utilisateur inconnu</span>
                        @endif
                    </div>
                </div>

                <!-- Contenu associé -->
                <div class="col-md-6">
                    <label class="form-label fw-medium text-muted small mb-1">Contenu associé</label>
                    <div class="fw-semibold text-dark">
                        @if($commentaire->contenu)
                            <a href="{{ route('contenus.show', $commentaire->contenu->id) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div>{{ $commentaire->contenu->titre }}</div>
                                    </div>
                                </div>
                            </a>
                        @else
                            <span class="text-muted">Aucun contenu associé</span>
                        @endif
                    </div>
                </div>

                <!-- Commentaire -->
                <div class="col-12">
                    <label class="form-label fw-medium text-muted small mb-1">Commentaire</label>
                    <div class="bg-light rounded p-4">
                        <p class="mb-0 text-dark" style="line-height: 1.6; white-space: pre-line;">{{ $commentaire->texte }}</p>
                    </div>
                </div>

                <!-- Dates -->
                <div class="col-12 mt-4">
                    <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                        <i class="bi bi-clock me-2"></i>Dates importantes
                    </h6>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium text-muted small mb-1">Date du commentaire</label>
                    <div class="fw-semibold text-dark">
                        {{ optional($commentaire->date ?? $commentaire->created_at)->format('d/m/Y à H:i') ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium text-muted small mb-1">Dernière modification</label>
                    <div class="fw-semibold text-dark">
                        {{ optional($commentaire->updated_at)->format('d/m/Y à H:i') ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer avec actions -->
        <div class="card-footer d-flex justify-content-between gap-2 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('commentaires.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Retour à la liste</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('commentaires.edit', $commentaire->id) }}" class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bi bi-pencil"></i>
                    <span>Modifier</span>
                </a>

                <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger d-flex align-items-center gap-2"
                            onclick="return confirm('Supprimer ce commentaire ?')">
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

    /* Étoiles pour les notes */
    .bi-star-fill {
        color: #ffc107;
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
        .text-center.mb-5 {
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

    // Animation des étoiles au survol
    const starRatings = document.querySelectorAll('.d-flex.align-items-center.gap-1');
    starRatings.forEach(rating => {
        rating.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'transform 0.2s ease';
        });
        rating.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Confirmation de suppression avec message personnalisé
    const deleteForms = document.querySelectorAll('form[onsubmit]');
    deleteForms.forEach(form => {
        form.onsubmit = function(e) {
            const userName = "{{ $commentaire->user ? $commentaire->user->prenom . ' ' . $commentaire->user->nom : 'Utilisateur inconnu' }}";
            return confirm(`Êtes-vous sûr de vouloir supprimer le commentaire de "${userName}" ? Cette action est irréversible.`);
        };
    });
});
</script>

@endsection