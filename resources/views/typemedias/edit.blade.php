@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Modifier un type de média</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('typemedias.index') }}" class="text-decoration-none">Types de médias</a></li>
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
                <h5 class="mb-1 fw-semibold text-dark">Formulaire de modification</h5>
                <p class="text-muted small mb-0">Modifiez les informations de ce type de média ci-dessous.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('typemedias.update', $typemedia->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label fw-medium text-dark">Nom du type de média<span class="text-danger">*</span></label>
                    <input type="text" 
                           name="nom" 
                           id="nom"
                           class="form-control @error('nom') is-invalid @enderror" 
                           placeholder="Ex: Article, Vidéo, Image"
                           value="{{ old('nom', $typemedia->nom) }}"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Footer avec boutons -->
            <div class="card-footer d-flex justify-content-end gap-3 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
                <a href="{{ route('typemedias.index') }}" 
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
    .form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        background-color: #fbfdff;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
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
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #e9ecef;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #495057;
    }
    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }
    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
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
            flex-direction: column-reverse;
            gap: 1rem;
        }
        .btn {
            justify-content: center;
            width: 100%;
        }
    }
</style>

@endsection