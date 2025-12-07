@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Modifier un utilisateur</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">Utilisateurs</a></li>
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
            <div class="d-flex align-items-center justify-content-between mb-4 gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar">
                        @if(!empty($user->photo))
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="avatar" class="rounded-circle" width="72" height="72">
                        @else
                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email ?? ''))) }}?s=72&d=mp" alt="avatar" class="rounded-circle" width="72" height="72">
                        @endif
                    </div>
                    <div class="user-title">
                        <h5 class="mb-1 fw-semibold text-dark">Éditer : {{ $user->nom ?? ($user->email ?? 'Utilisateur') }}</h5>
                        <p class="text-muted small mb-0">Modifiez les informations de cet utilisateur ci-dessous.</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                         <label for="nom" class="form-label fw-medium text-dark">Nom</label>
                         <input type="text" 
                                name="nom" 
                                id="nom"
                                class="form-control @error('nom') is-invalid @enderror" 
                                placeholder="Ex: Dupont"
                                value="{{ old('nom', $user->nom) }}"
                                >
                         @error('nom')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="prenom" class="form-label fw-medium text-dark">Prénom</label>
                         <input type="text" 
                                name="prenom" 
                                id="prenom"
                                class="form-control @error('prenom') is-invalid @enderror" 
                                placeholder="Ex: Jean"
                                value="{{ old('prenom', $user->prenom) }}"
                                >
                         @error('prenom')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="email" class="form-label fw-medium text-dark">Email</label>
                         <input type="email" 
                                name="email" 
                                id="email"
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Ex: jean.dupont@example.com"
                                value="{{ old('email', $user->email) }}"
                                >
                         @error('email')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="id_role" class="form-label fw-medium text-dark">Rôle</label>
                         <select name="id_role" 
                                 id="id_role" 
                                 class="form-select @error('id_role') is-invalid @enderror"
                                 >
                             <option value="">-- Sélectionner --</option>
                             @foreach($roles ?? [] as $role)
                                    <option value="{{ $role->id }}" {{ old('id_role', $user->id_role) == $role->id ? 'selected' : '' }}>
                                        {{ $role->nom }}
                                    </option>
                             @endforeach
                         </select>
                         @error('id_role')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                        <label for="id_langue" class="form-label fw-medium text-dark">Langue</label>
                        <select name="id_langue" 
                                id="id_langue" 
                                class="form-select @error('id_langue') is-invalid @enderror"
                                >
                            <option value="">-- Sélectionner --</option>
                            @foreach($langues ?? [] as $langue)
                                   <option value="{{ $langue->id }}" {{ old('id_langue', $user->id_langue) == $langue->id ? 'selected' : '' }}>
                                       {{ $langue->nom }}
                                   </option>
                            @endforeach
                        </select>
                        @error('id_langue')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="col-md-6">
                         <label for="statut" class="form-label fw-medium text-dark">Statut</label>
                         <select name="statut" 
                                 id="statut" 
                                 class="form-select @error('statut') is-invalid @enderror"
                                 >
                             <option value="">-- Sélectionner --</option>
                             <option value="Actif" {{ old('statut', $user->statut) == 'Actif' ? 'selected' : '' }}>Actif</option>
                             <option value="Inactif" {{ old('statut', $user->statut) == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                         </select>
                         @error('statut')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="sexe" class="form-label fw-medium text-dark">Sexe</label>
                         <select name="sexe" 
                                 id="sexe" 
                                 class="form-select @error('sexe') is-invalid @enderror"
                                 >
                             <option value="">-- Sélectionner --</option>
                             <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>Homme</option>
                             <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>Femme</option>
                         </select>
                         @error('sexe')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="date_naissance" class="form-label fw-medium text-dark">Date de naissance</label>
                         <input type="date" 
                                name="date_naissance" 
                                id="date_naissance"
                                class="form-control @error('date_naissance') is-invalid @enderror" 
+                               value="{{ old('date_naissance', $user->date_naissance ? $user->date_naissance->format('Y-m-d') : '') }}"
                                >
                         @error('date_naissance')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
 
                    <div class="col-md-6">
                         <label for="mot_de_passe" class="form-label fw-medium text-dark">Mot de passe (laisser vide = inchangé)</label>
                         <input type="password" 
                                name="mot_de_passe" 
                                id="mot_de_passe"
                                class="form-control @error('mot_de_passe') is-invalid @enderror" 
                                placeholder="Laisser vide pour ne pas changer"
                                autocomplete="new-password">
                         @error('mot_de_passe')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-6">
                         <label for="mot_de_passe_confirmation" class="form-label fw-medium text-dark">Confirmer le mot de passe</label>
                         <input type="password" 
                                name="mot_de_passe_confirmation" 
                                id="mot_de_passe_confirmation"
                                class="form-control @error('mot_de_passe_confirmation') is-invalid @enderror" 
                                placeholder="Confirmer si mot de passe changé"
                                autocomplete="new-password">
                         @error('mot_de_passe_confirmation')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                     </div>
 
                    <div class="col-md-12">
                         <label for="photo" class="form-label fw-medium text-dark">Remplacer la photo de profil</label>
                         <input type="file" 
                                name="photo" 
                                id="photo"
                                class="form-control @error('photo') is-invalid @enderror" 
                                accept="image/*">
                         @error('photo')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                         <div class="form-text">Taille maximale recommandée : 2MB. Formats : jpg, png, gif.</div>
                     </div>
                 </div>

            </div>

            <!-- Footer avec boutons -->
            <div class="card-footer d-flex justify-content-end gap-3 p-4" style="background-color: #f8f9fa; border-top: 1px solid #e9ecef; border-radius: 0 0 12px 12px;">
                <a href="{{ route('users.index') }}" 
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