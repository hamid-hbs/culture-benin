@extends('layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 fw-semibold text-dark">Liste des utilisateurs</h3>
    </div>

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
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
                <h5 class="mb-1 fw-semibold text-dark">Gestion des utilisateurs</h5>
                <p class="text-muted small mb-0">{{ $users->total() }} utilisateur(s) au total</p>
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
                <a href="{{ route('users.create') }}"
                   class="btn btn-success d-flex align-items-center gap-2"
                   style="border-radius: 8px; padding: 10px 20px;">
                    <i class="bi bi-plus-lg"></i>
                    <span>Ajouter un utilisateur</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle" style="border-collapse: collapse;">
                
                 <thead>
                     <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th class="border-0 py-3 ps-3" style="border-radius: 8px 0 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Photo</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Nom</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Prénom</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Email</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Rôle</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Statut</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Date d'inscription</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Sexe</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Date de naissance</span>
                        </th>
                        <th class="border-0 py-3">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Langue</span>
                        </th>
                        <th class="border-0 py-3 text-center pe-3" style="border-radius: 0 8px 0 0;">
                            <span class="text-uppercase fw-semibold text-primary" style="font-size: 0.75rem; letter-spacing: 0.5px;">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr style="border-bottom: 1px solid #f1f3f5;">
                        <td class="ps-3 py-3" style="width: 56px;">
                            @if(!empty($user->photo))
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="avatar" class="rounded-circle" width="48" height="48">
                            @else
                                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email ?? ''))) }}?s=48&d=mp" alt="avatar" class="rounded-circle" width="48" height="48">
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ $user->nom }}</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ $user->prenom }}</span>
                        </td>
                        <td class="py-3">
                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ optional($user->role)->nom ?? (isset($user->roles) ? $user->roles->pluck('nom')->join(', ') : '-') }}</span>
                        </td>
                        <td class="py-3">
                            @if($user->statut == 'Actif')
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <span class="text-muted">{{ optional($user->date_inscription)->format('d/m/Y H:i') ?? '-' }}</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ $user->sexe ?? '-' }}</span>
                        </td>
                        <td class="py-3">
                            <span class="text-muted">{{ optional($user->date_naissance)->format('d/m/Y') ?? '-' }}</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-medium text-dark">{{ optional($user->langue)->nom ?? '-' }}</span>
                        </td>
                        
                        <td class="text-center pe-3 py-3">
                            <div class="d-inline-flex gap-2">
                                <!-- Bouton Voir -->
                                <a href="{{ route('users.show', $user->id) }}" 
                                   class="btn btn-sm btn-info d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Voir">
                                    <i class="bi bi-eye" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Modifier -->
                                <a href="{{ route('users.edit', $user->id) }}" 
                                   class="btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                   style="width: 34px; height: 34px; border-radius: 6px;"
                                   title="Modifier">
                                    <i class="bi bi-pencil" style="font-size: 0.9rem;"></i>
                                </a>

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('users.destroy', $user->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px; border-radius: 6px;"
                                            onclick="return confirm('Supprimer cet utilisateur ?')"
                                            title="Supprimer">
                                        <i class="bi bi-trash" style="font-size: 0.9rem;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-inbox text-indigo-muted mb-3" style="font-size: 3rem; opacity: 0.4;"></i>
                                <p class="text-indigo-muted mb-0">Aucun utilisateur trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
            <div class="text-muted small">
                Affichage de <strong>{{ $users->firstItem() ?? 0 }}</strong> à <strong>{{ $users->lastItem() ?? 0 }}</strong> sur <strong>{{ $users->total() }}</strong>
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
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