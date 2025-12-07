@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Liste des contenus</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contenus</li>
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
                <h5 class="mb-1 fw-semibold text-dark">Gestion des contenus</h5>
                <p class="text-muted small mb-0">{{ $contenus->total() }} contenu(s) au total</p>
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
                <a href="{{ route('contenus.create') }}"
                   class="btn btn-success d-flex align-items-center gap-2"
                   style="border-radius: 8px; padding: 10px 20px;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Ajouter un contenu</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" style="border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th class="py-3 text-primary">Titre</th>
                        <th class="py-3 text-primary">Texte</th>
                        <th class="py-3 text-primary">Type</th>
                        <th class="py-3 text-primary">Langue</th>
                        <th class="py-3 text-primary">Région</th>
                        <th class="py-3 text-primary">Parent</th>
                        <th class="py-3 text-primary">Auteur</th>
                        <th class="py-3 text-primary">Modérateur</th>
                        <th class="py-3 text-primary">Statut</th>
                        <th class="py-3 text-primary">Création</th>
                        <th class="py-3 text-primary">Validation</th>
                        <th class="py-3 text-primary text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($contenus as $contenu)
                    <tr style="border-bottom: 1px solid #f1f3f5;">

                        <td class="py-3">
                            <div class="d-flex flex-column">
                                <span class="fw-semibold text-dark">{{ $contenu->titre ?? '-' }}</span>
                            </div>
                        </td>

                        <td class="py-3"><small class="text-muted">{{ Str::limit($contenu->texte ?? '-', 80) }}</small></td>

                        <td class="py-3"><span class="fw-medium text-dark">{{ optional($contenu->typecontenu)->nom ?? optional($contenu->id_type_contenu)->nom ?? '-' }}</span></td>

                        <td class="py-3"><span class="fw-medium text-dark">{{ optional($contenu->langue)->nom ?? '-' }}</span></td>

                        <td class="py-3"><span class="text-dark">{{ optional($contenu->region)->nom ?? ( $contenu->id_region ?? '-' ) }}</span></td>

                        <td class="py-3"><span class="text-dark">{{ optional($contenu->parent)->titre ?? ($contenu->parent_id ? 'ID:'+ $contenu->parent_id : '-') }}</span></td>

                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ trim(($contenu->auteur->nom ?? '') . ' ' . ($contenu->auteur->prenom ?? '')) ?: (optional($contenu->auteur)->email ?? '-') }}</span>
                        </td>

                        <td class="py-3"><span class="text-dark">{{ trim(($contenu->moderateur->nom ?? '') . ' ' . ($contenu->moderateur->prenom ?? '')) ?: ($contenu->id_moderateur ?? '-') }}</span></td>

                        <td class="py-3">
                            @if(!empty($contenu->statut) && in_array(strtolower($contenu->statut), ['published','publié','actif','active']))
                                <span class="badge bg-success rounded-pill px-3 py-2">{{ $contenu->statut }}</span>
                            @elseif(!empty($contenu->statut) && in_array(strtolower($contenu->statut), ['draft','brouillon']))
                                <span class="badge bg-warning rounded-pill px-3 py-2">{{ $contenu->statut }}</span>
                            @elseif(!empty($contenu->statut))
                                <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $contenu->statut }}</span>
                            @else
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2">Non défini</span>
                            @endif
                        </td>

                        <td class="py-3">
                            <div class="d-flex flex-column">
                                <span class="text-dark fw-medium">{{ optional($contenu->date_creation ?? $contenu->created_at)->format('d/m/Y') ?? '-' }}</span>
                                <small class="text-muted">{{ optional($contenu->date_creation ?? $contenu->created_at)->format('H:i') ?? '' }}</small>
                            </div>
                        </td>

                        <td class="py-3">
                            @if($contenu->date_validation)
                                <span class="text-dark">{{ optional($contenu->date_validation)->format('d/m/Y H:i') }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td class="text-center pe-3 py-3">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('contenus.show', $contenu->id) }}" class="btn btn-sm btn-info" style="width:34px;height:34px;border-radius:6px;"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('contenus.edit', $contenu->id) }}" class="btn btn-sm btn-warning" style="width:34px;height:34px;border-radius:6px;"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('contenus.destroy', $contenu->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="width:34px;height:34px;border-radius:6px;" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <p class="text-muted mb-2">Aucun contenu trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
             </table>
         </div>
        
        <!-- Pagination -->
        @if($contenus->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
            <div class="text-muted small">
                Affichage de <strong>{{ $contenus->firstItem() ?? 0 }}</strong> à <strong>{{ $contenus->lastItem() ?? 0 }}</strong> sur <strong>{{ $contenus->total() }}</strong> contenu(s)
            </div>
            <div>
                {{ $contenus->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    /* Styles cohérents avec la table utilisateurs */
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
    }

    @media (max-width: 576px) {
        .card-header .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
        .card-header .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

{{-- Toast notifications --}}
@if(session('success') || session('error') || session('message'))
<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index:1080;">
    <div id="flashToast" class="toast align-items-center text-white border-0 {{ session('error') ? 'bg-danger' : 'bg-success' }}" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi {{ session('error') ? 'bi-exclamation-triangle' : 'bi-check-circle' }} me-2"></i>
                {{ session('success') ?? session('message') ?? session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('flashToast');
        if (!toastEl) return;

        // Bootstrap 5 toast init
        try {
            var bsToast = new bootstrap.Toast(toastEl, { delay: 4000 });
            bsToast.show();
        } catch (e) {
            // fallback: make it visible then hide after delay
            toastEl.style.display = 'block';
            setTimeout(function () { toastEl.style.display = 'none'; }, 4000);
        }

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
    });
</script>

@endsection