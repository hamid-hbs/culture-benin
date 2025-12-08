<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Patrimoine Immatériel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
:root {
    --primary-color: #10b981;
    --secondary-color: #34d399;
    --accent-color: #059669;
    --dark-green: #047857;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --background-light: #f9fafb;
    --white: #ffffff;
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --soft-green: #ecfdf5;
    --nav-gradient: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    --hero-overlay:  linear-gradient(135deg, rgba(39, 174, 96, 0.3) 0%, rgba(22, 160, 133, 0.2) 100%);
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
    scroll-behavior: smooth;
    overflow-x: hidden;
}

/* Section carousel avec texte statique */
.fullscreen-carousel {
    height: 100vh;
    position: relative;
    overflow: hidden;
    margin-top: 76px;
}

.carousel-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.carousel-item {
    height: 100vh;
    transition: transform 0.6s ease-in-out;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
    width: 100%;
    filter: brightness(0.8);
}

/* Contenu statique au-dessus du carousel */
.static-hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    text-align: center;
    max-width: 900px;
    padding: 3rem;
    z-index: 10;
    width: 90%;
}

.static-hero-content h1 {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    font-weight: 800;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    line-height: 1.1;
}

.static-hero-content p {
    font-size: 1.4rem;
    line-height: 1.7;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    opacity: 0.95;
    font-weight: 300;
}

.btn-hero {
    padding: 1.2rem 3rem;
    font-size: 1.2rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: white;
    font-weight: 600;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    display: inline-block;
}

.btn-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-hero:hover::before {
    left: 100%;
}

.btn-hero:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.6);
}

/* Overlay fixe pour améliorer la lisibilité */
.static-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--hero-overlay);
    z-index: 2;
}

/* Indicateurs du carousel */
.carousel-indicators {
    bottom: 40px;
    z-index: 10;
}

.carousel-indicators button {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    border: 2px solid transparent;
    margin: 0 10px;
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: white;
    width: 40px;
    border-radius: 10px;
    border-color: rgba(255, 255, 255, 0.8);
}

/* Sections */
.section {
    padding: 6rem 0;
    position: relative;
}

.section-title {
    text-align: center;
    margin-bottom: 3rem;
    color: var(--text-dark);
    font-weight: 800;
    font-size: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

.section-title span {
    color: var(--primary-color);
}

.section-subtitle {
    text-align: center;
    color: var(--text-light);
    font-size: 1.3rem;
    max-width: 800px;
    margin: 0 auto 4rem auto;
    line-height: 1.7;
    font-weight: 300;
}

/* Cartes de fonctionnalités */
.feature-card {
    background: var(--white);
    border-radius: 20px;
    padding: 3rem 2rem;
    text-align: center;
    box-shadow: var(--card-shadow);
    transition: all 0.4s ease;
    height: 100%;
    border: 1px solid rgba(16, 185, 129, 0.1);
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: var(--nav-gradient);
}

.feature-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.feature-icon {
    font-size: 4rem;
    margin-bottom: 2rem;
    background: var(--nav-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: inline-block;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(5deg);
}

.feature-card h3 {
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    font-weight: 700;
    font-size: 1.6rem;
}

.feature-card p {
    color: var(--text-light);
    line-height: 1.7;
    font-size: 1.1rem;
}

/* =========================================== */
/* NOUVEAU STYLE POUR LA SECTION CONTENUS */
/* =========================================== */
.culture-section {
    background: var(--soft-green);
    position: relative;
}

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

.media-load-more {
    text-align: center;
    margin-top: 3rem;
}

.load-more-btn {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-green) 100%);
    color: white;
    border: none;
    padding: 1rem 3rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    text-decoration: none;
    display: inline-block;
}

.load-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
}

/* Section statistiques */
.stats-section {
    background: var(--nav-gradient);
    color: white;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.05"><polygon points="1000,100 1000,0 0,100"></polygon></svg>');
    background-size: cover;
}

.stat-card {
    text-align: center;
    padding: 2rem;
    position: relative;
    z-index: 1;
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    display: block;
}

.stat-label {
    font-size: 1.2rem;
    opacity: 0.9;
    font-weight: 300;
}

/* Section langues */
.languages-section {
    background: var(--white);
}

.language-cloud {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.language-badge {
    display: inline-flex;
    align-items: center;
    background: var(--white);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    box-shadow: var(--card-shadow);
    border: 2px solid transparent;
    font-weight: 600;
    color: var(--text-dark);
    transition: all 0.3s ease;
    cursor: pointer;
}

.language-badge:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
}


/* Section communauté */
.community-section {
    background: var(--white);
}

.community-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.community-card {
    background: var(--white);
    border-radius: 15px;
    padding: 2rem;
    box-shadow: var(--card-shadow);
    border-left: 5px solid var(--primary-color);
    transition: all 0.3s ease;
    text-align: center;
}

.community-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.community-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    color: var(--primary-color);
}

/* Scroll indicator */
.scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    text-align: center;
    animation: bounce 2s infinite;
    z-index: 10;
}

.scroll-indicator i {
    font-size: 2.5rem;
    opacity: 0.8;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) translateX(-50%);
    }
    40% {
        transform: translateY(-15px) translateX(-50%);
    }
    60% {
        transform: translateY(-7px) translateX(-50%);
    }
}


/* Responsive */
@media (max-width: 992px) {
    .static-hero-content h1 {
        font-size: 3.5rem;
    }
    
    .media-grid-container {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .event-timeline::before {
        left: 30px;
    }
    
    .event-item {
        flex-direction: row !important;
    }
    
    .event-date {
        margin-left: 0;
        margin-right: 2rem;
    }
}

@media (max-width: 768px) {
    .static-hero-content h1 {
        font-size: 2.8rem;
    }
    
    .static-hero-content p {
        font-size: 1.2rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .section {
        padding: 4rem 0;
    }
    
    .media-grid-container {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .media-card-header {
        height: 200px;
    }
}

@media (max-width: 576px) {
    .static-hero-content h1 {
        font-size: 2.2rem;
    }
    
    .btn-hero {
        padding: 1rem 2rem;
        font-size: 1rem;
    }
    
    .media-card-body {
        padding: 1.5rem;
    }
    
    .media-card-title {
        font-size: 1.2rem;
    }
}
    </style>
</head>
<body>
    

    @include('front.header')

    <!-- Section carousel avec texte statique -->
    <section class="fullscreen-carousel" id="accueil">
        <!-- Overlay fixe pour la lisibilité -->
        <div class="static-overlay"></div>
        
        <!-- Contenu statique -->
        <div class="static-hero-content">
            <h1>Culture du Bénin</h1>
            <p>Découvrez la richesse de nos traditions, langues et savoirs ancestraux à travers une plateforme dédiée à la préservation de notre héritage culturel.</p>
            <p>Rejoignez notre communauté engagée dans la transmission de notre patrimoine aux générations futures.</p>
            <a href="{{ route('contenustous') }}" class="btn-hero">Explorer la Culture</a>
        </div>
        
        <!-- Carousel en arrière-plan -->
        <div class="carousel-container">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="5"></button>
                </div>
                
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="4000">
                        <img src="{{ asset('images/drapeau.jpg') }}" class="d-block w-100" alt="Drapeau du Bénin">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('images/amazone.jpg') }}" class="d-block w-100" alt="Amazones du Bénin">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('images/egoun.jpg') }}" class="d-block w-100" alt="Masques Egoun">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('images/chevaux.jpeg') }}" class="d-block w-100" alt="Chevaux de parade">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('images/ablo.jpg') }}" class="d-block w-100" alt="Art Ablo">
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="{{ asset('images/agoun.png') }}" class="d-block w-100" alt="Cérémonie Agoun">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
            <p>Découvrir</p>
        </div>
    </section>

    <!-- Section mission -->
    <section class="section" id="mission">
        <div class="container">
            <h2 class="section-title">Notre <span>mission</span></h2>
            <p class="section-subtitle">Une plateforme participative pour documenter, valoriser et diffuser la culture béninoise dans toute sa diversité et sa richesse.</p>
            
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>Documentation Complète</h3>
                        <p>Archivage systématique des traditions orales, contes, proverbes et savoirs ancestraux pour les générations futures.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <h3>Valorisation Linguistique</h3>
                        <p>Promotion active des langues nationales comme véhicules essentiels de transmission du patrimoine culturel.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3>Communauté Active</h3>
                        <p>Espace collaboratif où chaque citoyen peut contribuer à enrichir et préserver notre héritage culturel commun.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- SECTION CONTENUS AVEC MÉDIAS -->
<section class="section culture-section" id="contenus">
    <div class="container">
        <h2 class="section-title">Contenus <span>Culturels</span></h2>
        <p class="section-subtitle">Explorez notre riche collection de ressources culturelles, des contes traditionnels aux œuvres artistiques contemporaines.</p>
        
        <div class="media-grid-container">
            @forelse($contenus as $contenu)
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
            @empty
            <div class="media-empty-state">
                <div class="media-empty-icon">
                    <i class="fas fa-images"></i>
                </div>
                <h3>Aucun contenu disponible</h3>
                <p>Les contenus culturels seront bientôt disponibles. Revenez plus tard pour découvrir notre collection.</p>
            </div>
            @endforelse
        </div>
        
        @if($contenus->count() > 0)
        <div class="media-load-more">
            <a href="{{ route('contenustous') }}" class="load-more-btn">
                <i class="fas fa-book-open me-2"></i> Voir tous les contenus
            </a>
        </div>
        @endif
    </div>
</section>



    <!-- Section statistiques -->
    <section class="section stats-section" id="statistiques">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <span class="stat-number" data-count="30">0</span>
                        <div class="stat-label">Langues Nationales</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <span class="stat-number" data-count="12">0</span>
                        <div class="stat-label">Régions couvertes</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div style="display:flex;align-items:baseline;justify-content:center;gap:0.4rem;">
                            <span class="stat-number" data-count="300">0</span>
                            <span class="stat-plus" style="font-size:3rem;font-weight:800;line-height:1;color:inherit;">+</span>
                        </div>
                        <div class="stat-label">Contributeurs Actifs</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div style="display:flex;align-items:baseline;justify-content:center;gap:0.4rem;">
                        <span class="stat-number" data-count="1000">0</span>
                         <span class="stat-plus" style="font-size:3rem;font-weight:800;line-height:1;color:inherit;">+</span>
                    </div>
                        <div class="stat-label">Archives Numérisées</div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Section communauté -->
    <section class="section community-section" id="communaute">
        <div class="container">
            <h2 class="section-title">Notre <span>Communauté</span></h2>
            <p class="section-subtitle">Rejoignez une communauté dynamique passionnée par la préservation et la promotion de notre patrimoine culturel.</p>
            
            <div class="community-grid">
                <div class="community-card">
                    <div class="community-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Experts Culturels</h4>
                    <p>Anthropologues, linguistes et historiens travaillant ensemble pour documenter et analyser notre patrimoine.</p>
                </div>
                
                <div class="community-card">
                    <div class="community-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>Étudiants Chercheurs</h4>
                    <p>Jeune génération engagée dans la recherche et la modernisation de la transmission culturelle.</p>
                </div>
                
                <div class="community-card">
                    <div class="community-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                    <h4>Porteurs de Traditions</h4>
                    <p>Détenteurs des savoirs ancestraux partageant leur expertise avec les générations futures.</p>
                </div>
                
                <div class="community-card">
                    <div class="community-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Bénévoles Passionnés</h4>
                    <p>Citoyens engagés contribuant à la collecte et à la diffusion de notre patrimoine culturel.</p>
                </div>
            </div>
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

        // Initialisation du carousel auto-play
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
                interval: 4000,
                wrap: true,
                pause: false
            });

            // Animation des statistiques
            const stats = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const stat = entry.target;
                        const target = parseInt(stat.getAttribute('data-count'));
                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;
                        
                        const timer = setInterval(() => {
                            current += step;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }
                            stat.textContent = Math.floor(current);
                        }, 16);
                        
                        observer.unobserve(stat);
                    }
                });
            }, { threshold: 0.5 });
            
            stats.forEach(stat => observer.observe(stat));
        });

        // Smooth scroll pour les liens de navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

    </script>
</body>
</html>