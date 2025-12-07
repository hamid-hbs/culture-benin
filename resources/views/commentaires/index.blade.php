@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Liste des commentaires</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Commentaires</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card border-0 shadow-sm" style="border-radius: 12px;">
    
    <div class="card-body p-4">
        
        <!-- Header avec bouton -->
        <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h5 class="mb-1 fw-semibold text-dark">Gestion des commentaires</h5>
                <p class="text-muted small mb-0">{{ $commentaires->total() }} commentaire(s) au total</p>
            </div>

            <div class="d-flex align-items-center gap-3 ms-3" style="flex: 1 1 auto; max-width: 720px;">
                <form action="{{ request()->url() }}" method="GET" class="d-flex gap-2 flex-grow-1">
                    <div class="position-relative flex-grow-1">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Rechercher..."
                               value="{{ request('search') }}"
                               style="border-radius: 8px; padding-left: 40px;">
                        <div class="position-absolute top-50 start-0 translate-middle-y ms-3">
                            <i class="bi bi-search text-muted"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ request()->url() }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div class="ms-3" style="flex: 0 0 auto;">
                <a href="{{ route('commentaires.create') }}"
                   class="btn btn-success d-flex align-items-center gap-2"
                   style="border-radius: 8px; padding: 10px 20px;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Ajouter un commentaire</span>
                </a>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" style="border-collapse: collapse;">
                
                 <thead>
                     <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Texte</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Note</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Utilisateur</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Contenu</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Date</span>
                        </th>
                        <th class="border-0 py-3 text-center pe-3" style="border-radius: 0 8px 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($commentaires as $commentaire)
                    <tr style="border-bottom: 1px solid #f1f3f5;">

                        <!-- Texte -->
                        <td class="py-3">
                            <div class="d-flex flex-column">
                                <span class="text-dark">{{ Str::limit($commentaire->texte, 80) }}</span>
                                @if(strlen($commentaire->texte) > 80)
                                <small class="text-muted mt-1" style="font-size: 0.75rem;">
                                    {{ Str::limit($commentaire->texte, 150) }}
                                </small>
                                @endif
                            </div>
                        </td>

                        <!-- Note -->
                        <td class="py-3">
                            @if(isset($commentaire->note) && $commentaire->note !== null && $commentaire->note !== '')
                                <div class="d-flex align-items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= (int) $commentaire->note)
                                            <i class="bi bi-star-fill text-warning" style="font-size: 0.9rem;"></i>
                                        @else
                                            <i class="bi bi-star text-muted" style="font-size: 0.9rem;"></i>
                                        @endif
                                    @endfor
                                    <span class="fw-medium text-dark ms-2">{{ $commentaire->note }}/5</span>
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- Utilisateur -->
                        <td class="py-3">
                            @if($commentaire->user)
                                <div class="d-flex align-items-center">
                                    @if(!empty($commentaire->user->photo))
                                        <img src="{{ asset('storage/' . $commentaire->user->photo) }}" 
                                             alt="Photo de {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}" 
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
                                        <div class="fw-medium text-dark">
                                            {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}
                                        </div>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            {{ $commentaire->user->email }}
                                        </small>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">Utilisateur inconnu</span>
                            @endif
                        </td>

                        <!-- Contenu -->
                        <td class="py-3">
                            @if($commentaire->contenu)
                                <div class="d-flex flex-column">
                                    <a href="{{ route('contenus.show', $commentaire->contenu->id) }}" 
                                       class="fw-medium text-decoration-none text-truncate" 
                                       style="max-width: 150px;">
                                        {{ $commentaire->contenu->titre }}
                                    </a>
                                </div>
                            @else
                                <span class="text-muted">Contenu supprimé</span>
                            @endif
                        </td>

                        <!-- Date -->
                        <td class="py-3">
                            <div class="d-flex flex-column">
                                @php
                                    $date = null;
                                    if (!empty($commentaire->date)) {
                                        try { $date = \Carbon\Carbon::parse($commentaire->date); } catch (\Throwable $e) { $date = null; }
                                    }
                                    if (!$date) { $date = optional($commentaire->created_at); }
                                @endphp

                                <span class="text-dark fw-medium">
                                    {{ $date ? $date->format('d/m/Y') : '-' }}
                                </span>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    {{ $date ? $date->format('H:i') : '' }}
                                </small>
                            </div>
                        </td>
                        
                        <!-- Actions -->
                        <td class="text-center pe-3 py-3">
                            <div class="d-inline-flex gap-2">
                                <!-- Bouton Voir -->
                                <a href="{{ route('commentaires.show', $commentaire->id) }}" 
                                   class="btn btn-sm btn-info d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Voir le commentaire">
                                    <i class="bi bi-eye" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Modifier -->
                                <a href="{{ route('commentaires.edit', $commentaire->id) }}" 
                                   class="btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Modifier le commentaire">
                                    <i class="bi bi-pencil" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('commentaires.destroy', $commentaire->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px; border-radius: 6px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
                                            title="Supprimer le commentaire">
                                        <i class="bi bi-trash" style="font-size: 0.9rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                               <p class="text-muted mb-2">Aucun commentaire trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
        
        <!-- Pagination -->
        @if($commentaires->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
            <div class="text-muted small">
                Affichage de <strong>{{ $commentaires->firstItem() ?? 0 }}</strong> à <strong>{{ $commentaires->lastItem() ?? 0 }}</strong> sur <strong>{{ $commentaires->total() }}</strong> commentaire(s)
            </div>
            <div>
                {{ $commentaires->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    /* Style global pour la carte */
    .card.border-0.shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        transition: box-shadow 0.15s ease-in-out;
    }
    .card.border-0.shadow-sm:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Table avec bordures */
    .table.table-bordered {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
    }

    .table.table-bordered th,
    .table.table-bordered td {
        border: 1px solid #e9ecef !important;
        vertical-align: middle;
    }

    /* En-tête coloré */
    .table.table-bordered thead tr {
        background: linear-gradient(90deg, rgba(13,110,253,0.04), rgba(102,16,242,0.03));
    }
    .table.table-bordered thead th {
        color: #053061;
        font-weight: 700;
        font-size: 0.78rem;
        border-bottom-width: 2px;
    }

    /* Alternance légère et hover */
    .table.table-bordered tbody tr:nth-child(even) {
        background-color: #fbfdff;
    }
    .table.table-bordered tbody tr:hover {
        background-color: #eef7ff !important;
        transition: background-color 0.18s ease;
    }

    /* Badges améliorés */
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.75rem;
    }

    .badge.rounded-pill {
        border-radius: 50rem !important;
    }

    /* Boutons */
    .btn {
        font-weight: 500;
        transition: all 0.15s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-1px);
    }

    /* Étoiles pour les notes */
    .bi-star-fill {
        color: #ffc107;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }
        .table-responsive {
            font-size: 0.875rem;
        }
        .d-inline-flex.gap-2 {
            gap: 0.25rem !important;
        }
        .btn-sm {
            width: 32px !important;
            height: 32px !important;
        }
        .col-md-8, .col-md-4 {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 1rem;
        }
        .btn {
            width: 100%;
            justify-content: center;
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
});
</script>

@endsection