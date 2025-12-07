@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Liste des langues</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Langues</li>
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
                <h5 class="mb-1 fw-semibold text-dark">Gestion des langues</h5>
                <p class="text-muted small mb-0">{{ $langues->total() }} langue(s) au total</p>
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
                <a href="{{ route('langues.create') }}"
                   class="btn btn-success d-flex align-items-center gap-2"
                   style="border-radius: 8px; padding: 10px 20px;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Ajouter une langue</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" style="border-collapse: collapse;">
                
                 <thead>
                     <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th class="border-0 py-3 ps-3" style="border-radius: 8px 0 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #0d6efd !important;">Code</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #0d6efd !important;">Nom</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #0d6efd !important;">Description</span>
                        </th>
                        <th class="border-0 py-3 text-center pe-3" style="border-radius: 0 8px 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px; color: #0d6efd !important;">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($langues as $langue)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                        <td class="ps-3 py-3">
                            <span class="badge bg-primary text-white" style="font-size: 0.85rem; font-weight: 500;">
                                {{ $langue->code }}
                            </span>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ $langue->nom }}</span>
                        </td>
                        <td class="py-3">
                            <span class="text-muted">{{ $langue->description ?: '—' }}</span>
                        </td>
                        
                        <td class="text-center pe-3 py-3">
                            <div class="d-inline-flex gap-2">
                                <!-- Bouton Voir -->
                                <a href="{{ route('langues.show', $langue->id) }}" 
                                   class="btn btn-sm btn-info border d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Voir">
                                    <i class="bi bi-eye" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Modifier -->
                                <a href="{{ route('langues.edit', $langue->id) }}" 
                                   class="btn btn-sm btn-warning border d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Modifier">
                                    <i class="bi bi-pencil" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('langues.destroy', $langue->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger border d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px; border-radius: 6px;"
                                            onclick="return confirm('Supprimer cette langue ?')"
                                            title="Supprimer">
                                        <i class="bi bi-trash" style="font-size: 0.9rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-inbox text-muted mb-3" style="font-size: 3rem; opacity: 0.4;"></i>
                                <p class="text-muted mb-0">Aucune langue trouvée</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
        
        <!-- Pagination -->
        @if($langues->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
            <div class="text-muted small">
                Affichage de <strong>{{ $langues->firstItem() ?? 0 }}</strong> à <strong>{{ $langues->lastItem() ?? 0 }}</strong> sur <strong>{{ $langues->total() }}</strong>
            </div>
            <div>
                {{ $langues->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    /* Faire une table bordée (lignes verticales + horizontales) */
    .table.table-bordered {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
    }

    .table.table-bordered th,
    .table.table-bordered td {
        border: 3px solid #e9ecef !important;
        vertical-align: middle;
    }

    /* En-tête coloré et plus net */
    .table.table-bordered thead tr {
        background: linear-gradient(90deg, rgba(13,110,253,0.04), rgba(102,16,242,0.03));
    }
    .table.table-bordered thead th {
        color: #0d6efd !important;
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

    /* Boutons et badge */
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
    }
    
</style>

{{-- Toast notifications --}}
@if(session('success') || session('error') || session('message'))
<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index:1080;">
    <div id="flashToast" class="toast align-items-center text-white border-0 {{ session('error') ? 'bg-danger' : 'bg-success' }}" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
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
    });
</script>

@endsection