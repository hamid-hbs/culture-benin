<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les contenus - Culture Bénin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #10b981;
            --secondary-color: #34d399;
            --accent-color: #059669;
            --dark-green: #047857;
            --text-dark: 1f2937;
            --text-light: #6b7280;
            --background-light: #f9fafb;
            --white: #ffffff;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --soft-green: #ecfdf5;
            --nav-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding-top: 76px;
        }

        

        /* Section contenus */
        .tous-contenus-section {
            min-height: 70vh;
            padding: 4rem 0;
        }

        .page-title {
            color: var(--text-dark);
            font-weight: 800;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 700px;
        }

        /* Barre de recherche */
        .search-container {
            background: var(--white);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            border: 2px solid rgba(16, 185, 129, 0.1);
            transition: all 0.3s ease;
        }

        .search-container:hover {
            border-color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1);
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            color: var(--text-dark);
            background: transparent;
        }

        .search-input::placeholder {
            color: var(--text-light);
        }

        .search-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-btn:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .search-results-info {
            background: rgba(16, 185, 129, 0.08);
            color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            margin-bottom: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contenus-count {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            display: inline-block;
            margin-bottom: 2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        /* Grille des contenus */
        .media-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2.5rem;
            margin-bottom: 4rem;
        }

        .media-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            border: 1px solid rgba(16, 185, 129, 0.1);
            height: 100%;
            position: relative;
        }

        .media-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .media-card-header {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .media-content {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .media-content img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s ease;
        }

        .media-card:hover .media-content img {
            transform: scale(1.08);
        }

        .video-player {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: #000;
        }

        .media-play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .media-card:hover .media-play-overlay {
            opacity: 1;
        }

        .play-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.8rem;
            transition: all 0.3s ease;
        }

        .play-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .media-type-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
        }

        .media-type-badge .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .badge-video {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .badge-image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-green) 100%);
        }

        .media-card-body {
            padding: 1.8rem;
        }

        .media-card-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .media-card-description {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .media-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .media-category {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .media-action-btn {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .media-action-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .media-empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 20px;
            border: 2px dashed rgba(16, 185, 129, 0.2);
        }

        .media-empty-icon {
            font-size: 4rem;
            color: rgba(16, 185, 129, 0.3);
            margin-bottom: 1.5rem;
        }

        .media-empty-state h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .media-empty-state p {
            color: var(--text-light);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination-custom .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .pagination-custom .page-link {
            color: var(--primary-color);
            border: 1px solid #dee2e6;
            padding: 0.75rem 1.25rem;
            margin: 0 5px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .pagination-custom .page-link:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }


        /* Responsive */
        @media (max-width: 768px) {
            .media-grid-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 2rem;
            }
            
            .page-title {
                font-size: 2.2rem;
            }
            
            .page-subtitle {
                font-size: 1.1rem;
            }

            .search-form {
                flex-direction: column;
                gap: 0.75rem;
            }

            .search-input {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .media-grid-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .media-card-header {
                height: 200px;
            }
            
            .media-card-body {
                padding: 1.5rem;
            }
            
            .media-card-title {
                font-size: 1.2rem;
            }
            
            body {
                padding-top: 70px;
            }
        }
    </style>
</head>
<body>
    @include('front.header')

    <!-- Section tous les contenus -->
    <section class="tous-contenus-section">
        <div class="container">
            <h1 class="page-title">Tous les contenus</h1>
            <p class="page-subtitle">Découvrez l'ensemble de notre collection culturelle, des traditions ancestrales aux créations contemporaines.</p>
            
            <!-- Barre de recherche -->
            <div class="search-container">
                <form method="GET" action="{{ route('contenustous') }}" class="search-form">
                    <div class="flex-grow-1">
                        <input type="text" 
                               name="search" 
                               class="search-input" 
                               placeholder="Rechercher par titre ou texte..." 
                               value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                        Rechercher
                    </button>
                </form>
            </div>

            @if(request('search'))
                <div class="search-results-info">
                    <i class="fas fa-search"></i>
                    Résultats pour : "{{ request('search') }}" ({{ $contenus->total() }} résultat(s))
                </div>
            @endif
            
            @if(isset($contenus) && $contenus->count() > 0)
                <div class="contenus-count">
                    {{ $contenus->total() }} contenu(s) disponible(s)
                </div>
                
                <div class="media-grid-container">
                    @foreach($contenus as $contenu)
                    <div class="media-card">
                        <div class="media-card-header">
                            <div class="media-content">
                                @if($contenu->media)
                                    @if($contenu->hasVideo())
                                        <!-- Vidéo -->
                                        <video class="video-player" controls preload="metadata">
                                            <source src="{{ asset('storage/' . $contenu->media->chemin) }}" 
                                                    type="video/{{ pathinfo($contenu->media->chemin, PATHINFO_EXTENSION) }}">
                                        </video>
                                        <div class="media-play-overlay">
                                            <div class="play-icon">
                                                <i class="fas fa-play"></i>
                                            </div>
                                        </div>
                                        <div class="media-type-badge">
                                            <span class="badge badge-video">
                                                <i class="fas fa-video me-1"></i> Vidéo
                                            </span>
                                        </div>
                                    @elseif($contenu->hasImage())
                                        <!-- Image -->
                                        <img src="{{ asset('storage/' . $contenu->media->chemin) }}" 
                                             alt="{{ $contenu->titre }}"
                                             loading="lazy">
                                        <div class="media-type-badge">
                                            <span class="badge badge-image">
                                                <i class="fas fa-image me-1"></i> Image
                                            </span>
                                        </div>
                                    @else
                                        <!-- Autre type de média -->
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-center">
                                                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">{{ $contenu->media->typemedia->nom ?? 'Fichier' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <!-- Pas de média -->
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center">
                                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Aucun média disponible</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="media-card-body">
                            <h3 class="media-card-title">{{ $contenu->titre }}</h3>
                            <p class="media-card-description">
                                {{ Str::limit(strip_tags($contenu->texte), 120) }}
                            </p>
                            
                            <div class="media-card-meta">
                                <span class="media-category">
                                    {{ $contenu->typecontenu->nom ?? 'Non classé' }}
                                </span>
                                <a href="{{ route('contenusdetails', $contenu->id) }}" class="media-action-btn">
                                    <i class="fas fa-eye me-1"></i> Voir plus
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($contenus->hasPages())
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-custom">
                            {{ $contenus->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
                </div>
                @endif
                
            @else
                <div class="media-empty-state">
                    <div class="media-empty-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h3>Aucun contenu disponible</h3>
                    <p>Les contenus culturels seront bientôt disponibles. Revenez plus tard pour découvrir notre collection.</p>
                </div>
            @endif
        </div>
    </section>

    @include('front.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation du header au scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.navbar-custom');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Gestion des vidéos dans les cartes
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.video-player').forEach(video => {
                const overlay = video.nextElementSibling;
                const playIcon = overlay.querySelector('.play-icon');
                
                playIcon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (video.paused) {
                        video.play();
                        overlay.style.opacity = '0';
                    } else {
                        video.pause();
                        overlay.style.opacity = '1';
                    }
                });
                
                video.addEventListener('play', function() {
                    overlay.style.opacity = '0';
                });
                
                video.addEventListener('pause', function() {
                    overlay.style.opacity = '1';
                });
            });
        });
    </script>
</body>
</html>