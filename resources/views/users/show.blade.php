@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Détails de l'utilisateur</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Utilisateurs</a></li>
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
                    <h5 class="mb-1 fw-semibold text-dark">{{ $user->nom ?? '-' }} {{ $user->prenom ?? '' }}</h5>
                    <p class="text-muted small mb-0">
                        {{ $user->username ? '@'.$user->username : '' }}
                        • {{ optional($user->created_at)->format('d/m/Y') ?? 'Date inconnue' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Photo de profil et statut -->
                <div class="col-md-4 text-center">
                    <div class="position-relative d-inline-block">
                        @if(!empty($user->photo))
                            <img src="{{ asset('storage/' . $user->photo) }}" 
                                 alt="Photo de {{ $user->prenom }} {{ $user->nom }}" 
                                 class="rounded-circle shadow-sm mb-3" 
                                 width="160" 
                                 height="160"
                                 style="object-fit: cover; border: 4px solid #fff;">
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3 mx-auto" 
                                 style="width: 160px; height: 160px; border: 4px solid #fff;">
                                <i class="bi bi-person-fill text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        
                        <!-- Badge de statut -->
                        <div class="position-absolute bottom-0 start-50 translate-middle-x">
                            @if(($user->statut ?? 'Actif') === 'Actif')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>Actif
                                </span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3 py-2">
                                    <i class="bi bi-pause-circle-fill me-1"></i>Inactif
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Informations rapides -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <div class="text-center">
                                <div class="fw-bold text-dark">{{($user->sexe ?? '-')}}</div>
                                <small class="text-muted">Sexe</small>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold text-dark">
                                    @if($user->date_naissance)
                                        {{ \Carbon\Carbon::parse($user->date_naissance)->age }} ans
                                    @else
                                        -
                                    @endif
                                </div>
                                <small class="text-muted">Âge</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de l'utilisateur -->
                <div class="col-md-8">
                    <div class="row g-3">
                        <!-- Informations personnelles -->
                        <div class="col-12">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-person-vcard me-2"></i>Informations personnelles
                            </h6>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Nom complet</label>
                            <div class="fw-semibold text-dark">{{ ($user->nom ?? '-') . ' ' . ($user->prenom ?? '') }}</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Email</label>
                            <div class="d-flex align-items-center">
                                <a href="mailto:{{ $user->email }}" class="fw-semibold text-decoration-none">
                                    {{ $user->email ?? '-' }}
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Date de naissance</label>
                            <div class="fw-semibold text-dark">
                                {{ $user->date_naissance ? \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') : '-' }}
                            </div>
                        </div>

                      
                        <!-- Informations du compte -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-gear me-2"></i>Informations du compte
                            </h6>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Rôle</label>
                            <div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fw-normal">
                                    {{ optional($user->role)->nom ?? '-'}}
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Langue</label>
                            <div class="fw-semibold text-dark">{{ optional($user->langue)->nom ?? '-' }}</div>
                        </div>


                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Statut</label>
                            <div>
                                @if(($user->statut ?? 'Actif') === 'Actif')
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i>Actif
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                                        <i class="bi bi-pause-circle me-1"></i>Inactif
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Métadonnées -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-semibold text-dark mb-3 pb-2 border-bottom">
                                <i class="bi bi-clock me-2"></i>Dates importantes
                            </h6>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Créé le</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($user->created_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-medium text-muted small mb-1">Mis à jour le</label>
                            <div class="fw-semibold text-dark">
                                {{ optional($user->updated_at)->format('d/m/Y à H:i') ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer avec boutons -->
        <div class="card-footer d-flex justify-content-between gap-2 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('users.index') }}" 
               class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Retour à la liste</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('users.edit', $user->id) }}" 
                   class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bi bi-pencil"></i>
                    <span>Modifier</span>
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger d-flex align-items-center gap-2"
                            onclick="return confirm('Supprimer cet utilisateur ?')">
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

    .form-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        .col-md-4.text-center {
            margin-bottom: 2rem;
        }
    }
</style>

@endsection