@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Liste des médias</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Médias</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="card border-0 shadow-sm" style="border-radius: 12px;">
    
    <div class="card-body p-4">
        
        <!-- Header avec bouton -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-1 fw-semibold text-dark">Gestion des médias</h5>
                <p class="text-muted small mb-0">{{ $medias->total() }} média(s) au total</p>
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
                <a href="{{ route('medias.create') }}"
                   class="btn btn-success d-flex align-items-center gap-2"
                   style="border-radius: 8px; padding: 10px 20px;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Ajouter un média</span>
                </a>
            </div>
        </div>
         

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" style="border-collapse: collapse;">
                
                 <thead>
                     <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th class="border-0 py-3 ps-3" style="border-radius: 8px 0 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Aperçu</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Chemin</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Description</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Type de média</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Contenu lié</span>
                        </th>
                        <th class="border-0 py-3 text-center pe-3" style="border-radius: 0 8px 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($medias as $media)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                        <!-- Aperçu du média -->
                        <td class="ps-3 py-3" style="width: 80px;">
                            @php
                                $chemin = $media->chemin;
                                $isImage = \Illuminate\Support\Str::contains($chemin, ['.jpg','.jpeg','.png','.gif','.webp','.bmp']);
                                $isVideo = \Illuminate\Support\Str::contains($chemin, ['.mp4','.webm','.ogg','.mov']);
                                $isAudio = \Illuminate\Support\Str::contains($chemin, ['.mp3','.wav','.ogg','.m4a']);
                            @endphp
                            
                            @if($isImage)
                                <img src="{{ asset('storage/'.$media->chemin) }}" 
                                     alt="Aperçu" 
                                     class="rounded shadow-sm" 
                                     style="width: 60px; height: 60px; object-fit: cover;"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="rounded bg-light d-flex align-items-center justify-content-center d-none" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @elseif($isVideo)
                                <div class="rounded bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-play-btn-fill text-primary"></i>
                                </div>
                            @elseif($isAudio)
                                <div class="rounded bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-music-note-beamed text-warning"></i>
                                </div>
                            @else
                                <div class="rounded bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="bi bi-file-earmark text-secondary"></i>
                                </div>
                            @endif
                        </td>

                        <!-- Chemin -->
                        <td class="py-3">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold text-dark text-truncate" style="max-width: 200px;">
                                    {{ basename($media->chemin) }}
                                </span>
                                <small class="text-muted mt-1" style="font-size: 0.75rem;">
                                    {{ dirname($media->chemin) }}
                                </small>
                            </div>
                        </td>

                        <!-- Description -->
                        <td class="py-3">
                            @if($media->description)
                                <span class="text-dark">{{ Str::limit($media->description, 50) }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- Type de média -->
                        <td class="py-3">
                            @if($media->typemedia)
                                <span class="badge bg-primary text-white rounded-pill px-3 py-2">
                                    {{ $media->typemedia->nom }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2">
                                    Non défini
                                </span>
                            @endif
                        </td>

                        <!-- Contenu lié -->
                        <td class="py-3">
                            @if($media->contenu)
                                <div class="d-flex flex-column">
                                    <a href="{{ route('contenus.show', $media->contenu->id) }}" 
                                       class="fw-medium text-decoration-none text-truncate" 
                                       style="max-width: 150px;">
                                        {{ $media->contenu->titre }}
                                    </a>
                                </div>
                            @else
                                <span class="text-muted">Aucun contenu</span>
                            @endif
                        </td>
                        
                        <!-- Actions -->
                        <td class="text-center pe-3 py-3">
                            <div class="d-inline-flex gap-2">
                                <!-- Bouton Voir -->
                                <a href="{{ route('medias.show', $media->id) }}" 
                                   class="btn btn-sm btn-info d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Voir le média">
                                    <i class="bi bi-eye" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Modifier -->
                                <a href="{{ route('medias.edit', $media->id) }}" 
                                   class="btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Modifier le média">
                                    <i class="bi bi-pencil" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('medias.destroy', $media->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px; border-radius: 6px;"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')"
                                            title="Supprimer le média">
                                        <i class="bi bi-trash" style="font-size: 0.9rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                
                                <p class="text-muted mb-2">Aucun média trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
        
        <!-- Pagination -->
        @if($medias->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
            <div class="text-muted small">
                Affichage de <strong>{{ $medias->firstItem() ?? 0 }}</strong> à <strong>{{ $medias->lastItem() ?? 0 }}</strong> sur <strong>{{ $medias->total() }}</strong> média(s)
            </div>
            <div>
                {{ $medias->links('pagination::bootstrap-5') }}
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

    /* Icônes pour les types de médias */
    .bi-image, .bi-play-btn-fill, .bi-music-note-beamed, .bi-file-earmark {
        font-size: 1.2rem;
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

    // Gestion des erreurs d'image
    const images = document.querySelectorAll('img[onerror]');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const fallback = this.nextElementSibling;
            if (fallback && fallback.classList.contains('d-none')) {
                fallback.classList.remove('d-none');
                fallback.style.display = 'flex';
            }
        });
    });
});
</script>

@endsection