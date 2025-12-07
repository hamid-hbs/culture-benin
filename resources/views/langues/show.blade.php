@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Détails de la langue</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('langues.index') }}" class="text-decoration-none">Langues</a></li>
            <li class="breadcrumb-item active" aria-current="page">Détails</li>
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
                <h5 class="mb-1 fw-semibold text-dark">{{ $langue->nom }}</h5>
                <p class="text-muted small mb-0">Voici les informations détaillées sur cette langue.</p>
            </div>

            <!-- Contenu des détails -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <label class="form-label fw-medium text-dark">Code de la langue</label>
                    <div class="p-3 bg-light rounded" style="border-left: 4px solid #0d6efd;">
                        <span class="badge bg-primary text-light fs-6 px-3 py-2">{{ $langue->code }}</span>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-medium text-dark">Nom de la langue</label>
                    <div class="p-3 bg-light rounded" style="border-left: 4px solid #0d6efd;">
                        <span class="fw-semibold text-dark fs-5">{{ $langue->nom }}</span>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-medium text-dark">Description de la langue</label>
                    <div class="p-3 bg-light rounded" style="border-left: 4px solid #0d6efd;">
                        @if($langue->description)
                            <p class="mb-0 text-muted">{{ $langue->description }}</p>
                        @else
                            <p class="mb-0 text-muted fst-italic">Aucune description fournie.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer avec boutons -->
        <div class="card-footer d-flex justify-content-between gap-2 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
            <a href="{{ route('langues.index') }}" 
               class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i>
                <span>Retour à la liste</span>
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('langues.edit', $langue->id) }}" 
                   class="btn btn-outline-warning d-flex align-items-center gap-2">
                    <i class="bi bi-pencil"></i>
                    <span>Modifier</span>
                </a>

                <form action="{{ route('langues.destroy', $langue->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-outline-danger d-flex align-items-center gap-2"
                            onclick="return confirm('Supprimer cette langue ?')">
                        <i class="bi bi-trash"></i>
                        <span>Supprimer</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    /* Style global pour la carte des détails */
    .card.border-0.shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        transition: box-shadow 0.15s ease-in-out;
    }
    .card.border-0.shadow-sm:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Labels et sections de détails */
    .form-label {
        font-size: 0.9rem;
        color: #053061;
        margin-bottom: 0.5rem;
    }
    .bg-light {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }
    .bg-light:hover {
        background-color: #fbfdff !important;
        border-color: #0d6efd;
        transition: all 0.15s ease-in-out;
    }

    /* Badge pour le code */
    .badge.bg-primary {
        background-color: #0d6efd !important;
        border-radius: 6px;
        font-weight: 500;
    }

    /* Boutons du footer */
    .btn {
        font-weight: 500;
        transition: all 0.15s ease-in-out;
        border-radius: 8px;
        padding: 10px 20px;
    }
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #e9ecef;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #495057;
    }
    .btn-outline-warning {
        color: #f59e0b;
        border-color: #f59e0b;
    }
    .btn-outline-warning:hover {
        background-color: #f59e0b;
        border-color: #f59e0b;
        color: #fff;
    }
    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    /* Icônes dans les boutons */
    .btn i {
        font-size: 1rem;
    }

    /* Responsive pour mobile */
    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .card-footer {
            flex-direction: column;
            gap: 1rem;
        }
        .btn {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endsection