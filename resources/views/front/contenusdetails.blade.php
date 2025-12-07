<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contenu->titre ?? 'Détails du contenu' }} - Culture Bénin</title>
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
            --border-color: #e5e7eb;
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
        /* Section détails */
        .details-section {
            min-height: 70vh;
            padding: 4rem 0 2rem;
        }
        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 2.5rem;
            font-size: 0.9rem;
        }
        .breadcrumb-custom .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--dark-green);
            text-decoration: underline;
        }
        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--text-light);
        }
        .contenu-header {
            margin-bottom: 3.5rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        .contenu-title {
            color: var(--text-dark);
            font-weight: 800;
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }
        .contenu-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .meta-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1px solid transparent;
        }
        .meta-badge.type {
            background: rgba(16, 185, 129, 0.08);
            color: var(--primary-color);
            border-color: rgba(16, 185, 129, 0.2);
        }
        .meta-badge.region {
            background: rgba(251, 191, 36, 0.08);
            color: #fbbf24;
            border-color: rgba(251, 191, 36, 0.2);
        }
        .meta-badge.langue {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.2);
        }
        .meta-badge.statut {
            background: rgba(59, 130, 246, 0.08);
            color: #3b82f6;
            border-color: rgba(59, 130, 246, 0.2);
        }
        .meta-badge.statut-pending {
            background: rgba(245, 158, 11, 0.08);
            color: #f59e0b;
            border-color: rgba(245, 158, 11, 0.2);
        }
        .contenu-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.95rem;
        }
        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .contenu-media-container {
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 3.5rem;
            box-shadow: var(--card-shadow);
            background: var(--white);
            border: 1px solid var(--border-color);
        }
        .media-display {
            width: 100%;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            overflow: hidden;
        }
        .media-display img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .media-display video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #000;
        }
        .media-description {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            background: var(--white);
        }
        .media-type-label {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .media-type-label.video {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        .media-type-label.image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-green) 100%);
            color: white;
        }
        .contenu-body {
            background: var(--white);
            border-radius: 12px;
            padding: 3rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 3.5rem;
            border: 1px solid var(--border-color);
        }
        .contenu-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 2rem;
        }
        .contenu-text p {
            margin-bottom: 1.5rem;
        }
        .contenu-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 1px solid var(--border-color);
        }
        .info-card {
            padding: 1.5rem;
            background: var(--soft-green);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        .info-card h4 {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-card p {
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 500;
        }
        /* Section commentaires */
        .comments-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid var(--border-color);
        }
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .section-title i {
            color: var(--primary-color);
        }
        .comments-container {
            background: var(--white);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }
        /* Formulaire commentaire */
        .comment-form-container {
            background: var(--white);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 3rem;
        }
        .comment-form-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
        }
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .form-control::placeholder {
            color: #9ca3af;
        }
        .btn-submit {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-submit:hover {
            background: var(--dark-green);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
        }
        /* Section connexion requise */
        .login-required {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            border: 2px dashed var(--border-color);
            margin-bottom: 3rem;
        }
        .login-required-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }
        .login-required h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        .login-required p {
            color: var(--text-light);
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .auth-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        /* Liste des commentaires */
        .comments-list {
            margin-top: 2.5rem;
        }
        .comment-item {
            padding: 1.75rem;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }
        .comment-item:last-child {
            border-bottom: none;
        }
        .comment-item:hover {
            background-color: #fafafa;
        }
        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .comment-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            margin-right: 1rem;
        }
        .comment-author {
            flex: 1;
        }
        .comment-author-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }
        .comment-date {
            font-size: 0.85rem;
            color: var(--text-light);
        }
        .comment-content {
            color: var(--text-dark);
            line-height: 1.7;
            margin-bottom: 1rem;
        }
        .comment-actions {
            display: flex;
            gap: 1.5rem;
        }
        .comment-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .comment-action:hover {
            color: var(--primary-color);
        }
        .comment-action i {
            font-size: 1rem;
        }
        .no-comments {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
        }
        .no-comments i {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }
        .no-comments h4 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        /* Bouton de retour */
        .back-button-container {
            text-align: center;
            margin-top: 3rem;
        }
        .btn-back {
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
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
        }
        /* Responsive */
        @media (max-width: 992px) {
            .media-display {
                height: 400px;
            }
           
            .contenu-title {
                font-size: 2.2rem;
            }
           
            .contenu-body,
            .comments-container,
            .comment-form-container {
                padding: 2rem;
            }
        }
        @media (max-width: 768px) {
            .media-display {
                height: 300px;
            }
           
            .contenu-title {
                font-size: 1.9rem;
            }
           
            .contenu-info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
           
            .auth-buttons {
                flex-direction: column;
                align-items: center;
            }
           
            .comment-header {
                flex-direction: column;
                align-items: flex-start;
            }
           
            .comment-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
        @media (max-width: 576px) {
            .media-display {
                height: 250px;
            }
           
            .contenu-title {
                font-size: 1.7rem;
            }
           
            .contenu-body,
            .comments-container,
            .comment-form-container,
            .login-required {
                padding: 1.5rem;
            }
           
            .contenu-meta {
                flex-direction: column;
                align-items: flex-start;
            }
           
            body {
                padding-top: 70px;
            }
        }
    </style>
</head>
<body>
    @include('front.header')
    <!-- Section détails du contenu -->
    <section class="details-section">
        <div class="container">
           
            <!-- Messages de session (erreurs/succès) -->
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 2rem; border-radius: 8px;">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 2rem; border-radius: 8px;">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- En-tête du contenu -->
            <div class="contenu-header">
                <h1 class="contenu-title">{{ $contenu->titre ?? 'Titre non disponible' }}</h1>
               
                <div class="contenu-meta">
                    <span class="meta-badge type">
                        <i class="fas fa-tag me-2"></i> {{ $contenu->typecontenu->nom ?? 'Non spécifié' }}
                    </span>
                   
                    <span class="meta-badge region">
                        <i class="fas fa-map-marker-alt me-2"></i> {{ $contenu->region->nom ?? 'Non spécifié' }}
                    </span>
                   
                    <span class="meta-badge langue">
                        <i class="fas fa-language me-2"></i> {{ $contenu->langue->nom ?? 'Non spécifié' }}
                    </span>
                   
                    <span class="meta-badge statut {{ $contenu->statut == 'en_attente' ? 'statut-pending' : '' }}">
                        <i class="fas fa-{{ $contenu->statut == 'validé' ? 'check-circle' : 'clock' }} me-2"></i>
                        {{ ucfirst($contenu->statut) }}
                    </span>
                </div>
               
                <div class="contenu-author">
                    <div class="author-avatar">
                        {{ substr($contenu->auteur->nom ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="mb-0">
                            <strong>{{ $contenu->auteur->nom ?? 'Auteur inconnu' }}</strong>
                            @if($contenu->date_creation)
                                · Publié le {{ \Carbon\Carbon::parse($contenu->date_creation)->format('d/m/Y') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <!-- Section de paiement (si l'utilisateur n'a pas payé et n'est pas admin) -->
            @auth
                @if(auth()->user()->role->nom !== 'Administrateur' && (!isset($hasPaid) || !$hasPaid))
                <div class="payment-required-section" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; padding: 3rem; text-align: center; border: 2px solid var(--border-color); margin-bottom: 3rem;">
                    <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1.5rem; opacity: 0.8;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">
                        Accès payant requis
                    </h3>
                    <p style="color: var(--text-light); margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                        Pour accéder au contenu complet de "<strong>{{ $contenu->titre }}</strong>", veuillez effectuer un paiement de <strong style="color: var(--primary-color); font-size: 1.2rem;">100 FCFA</strong>.
                    </p>
                    <a href="{{ route('payment.initiate', $contenu->id) }}" class="btn" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-green) 100%); color: white; border: none; padding: 1rem 3rem; border-radius: 25px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2); text-decoration: none; display: inline-block;">
                        <i class="fas fa-credit-card me-2"></i> Payer 100 FCFA pour accéder
                    </a>
                </div>
                @endif
            @endauth
            @guest
            <div class="payment-required-section" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; padding: 3rem; text-align: center; border: 2px solid var(--border-color); margin-bottom: 3rem;">
                <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1.5rem; opacity: 0.8;">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">
                    Connexion requise
                </h3>
                <p style="color: var(--text-light); margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                    Pour accéder à ce contenu, vous devez être connecté et effectuer un paiement de <strong style="color: var(--primary-color); font-size: 1.2rem;">100 FCFA</strong>.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('login') }}" class="btn" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-green) 100%); color: white; border: none; padding: 1rem 3rem; border-radius: 25px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2); text-decoration: none; display: inline-block;">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </a>
                </div>
            </div>
            @endguest
            <!-- Affichage du média (si l'utilisateur a payé ou est admin) -->
            @auth
                @if(auth()->user()->role->nom === 'Administrateur' || (isset($hasPaid) && $hasPaid))
                @if($contenu->media)
                <div class="contenu-media-container">
                    <div class="media-display">
                        @if($contenu->hasVideo())
                            <video controls class="w-100 h-100">
                                <source src="{{ asset('storage/' . $contenu->media->chemin) }}"
                                        type="video/{{ pathinfo($contenu->media->chemin, PATHINFO_EXTENSION) }}">
                                Votre navigateur ne supporte pas la lecture vidéo.
                            </video>
                        @elseif($contenu->hasImage())
                            <img src="{{ asset('storage/' . $contenu->media->chemin) }}"
                                 alt="{{ $contenu->media->description ?? $contenu->titre }}"
                                 class="img-fluid">
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-file-alt fa-5x mb-3"></i>
                                <p class="h4">{{ $contenu->media->typemedia->nom ?? 'Fichier' }}</p>
                            </div>
                        @endif
                    </div>
                   
                    <div class="media-description">
                        <span class="media-type-label
                            {{ $contenu->hasVideo() ? 'video' : ($contenu->hasImage() ? 'image' : 'other') }}">
                            <i class="fas fa-{{ $contenu->hasVideo() ? 'video' : ($contenu->hasImage() ? 'image' : 'file') }} me-2"></i>
                            {{ $contenu->hasVideo() ? 'Vidéo' : ($contenu->hasImage() ? 'Image' : ($contenu->media->typemedia->nom ?? 'Fichier')) }}
                        </span>
                       
                        <!--@if($contenu->media->description)
                            <p class="mb-0">{{ $contenu->media->description }}</p>
                        @endif-->
                    </div>
                </div>
                @endif
                @endif
            @endauth
            <!-- Corps du contenu (si l'utilisateur a payé ou est admin) -->
            @auth
                @if(auth()->user()->role->nom === 'Administrateur' || (isset($hasPaid) && $hasPaid))
                <div class="contenu-body">
                    <div class="contenu-text">
                        {!! nl2br(e($contenu->texte ?? 'Contenu non disponible')) !!}
                    </div>
                </div>
                @elseif(true)
                <!-- Aperçu du contenu pour les utilisateurs connectés mais non payants et non admins -->
                <div class="contenu-body" style="position: relative;">
                    <div class="contenu-text" style="filter: blur(5px); user-select: none; pointer-events: none;">
                        {!! nl2br(e(Str::limit($contenu->texte ?? 'Contenu non disponible', 200))) !!}
                    </div>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; z-index: 10;">
                        <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Contenu verrouillé - Paiement requis</p>
                    </div>
                </div>
                @endif
            @endauth
            <!-- Section commentaires -->
            <div class="comments-section">
                <h2 class="section-title">
                    <i class="fas fa-comments"></i>
                    Commentaires
                    @if(isset($comments_count) && $comments_count > 0)
                        <span class="badge bg-primary ms-2">{{ $comments_count }}</span>
                    @endif
                </h2>
                <!-- Section connexion requise pour commenter -->
                @guest
                <div class="login-required">
                    <div class="login-required-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Connexion requise</h3>
                    <p>Pour participer aux discussions et laisser un commentaire, veuillez vous connecter à votre compte Culture Bénin.</p>
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}" class="btn btn-solid-nav btn-nav-custom">
                            <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                        </a>
                       
                    </div>
                </div>
                @endguest
                <!-- Formulaire d'ajout de commentaire (visible uniquement si connecté) -->
                @auth
                <div class="comment-form-container">
                    <h3 class="comment-form-title">Ajouter un commentaire</h3>
                    <form id="commentForm" method="POST" action="{{ route('commentaires.userStore') }}">
                        @csrf
                        <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">
                       
                        <div class="form-group">
                            <label for="texte" class="form-label">Votre commentaire</label>
                            <textarea
                                class="form-control"
                                id="texte"
                                name="texte"
                                rows="4"
                                placeholder="Partagez vos pensées sur ce contenu culturel..."
                                required
                            ></textarea>
                        </div>
                       
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane me-2"></i> Publier le commentaire
                        </button>
                    </form>
                </div>
                @endauth
                <!-- Liste des commentaires -->
                <div class="comments-container">
                    <h3 class="comment-form-title">Commentaires de la communauté</h3>
                   
                    @if(isset($commentaires) && $commentaires->count() > 0)
                        <div class="comments-list">
                            @foreach($commentaires as $commentaire)
                            <div class="comment-item">
                                <div class="comment-header">
                                    <div class="comment-avatar">
                                        {{ substr(($commentaire->user->nom ?? 'U'), 0, 1) }}
                                    </div>
                                    <div class="comment-author">
                                        <div class="comment-author-name">
                                            {{-- Nom dynamique du commentateur --}}
                                            {{ $commentaire->user->nom ?? 'U' }}
                                          
                                            {{-- Badge rôle dynamique si défini dans user --}}
                                            @if($commentaire->user && isset($commentaire->user->role->nom))
                                                @switch($commentaire->user->role->nom)
                                                    @case('Administrateur')
                                                        <span class="badge bg-danger ms-1">Admin</span>
                                                        @break
                                                    @case('Modérateur')
                                                        <span class="badge bg-warning ms-1">Modérateur</span>
                                                        @break
                                                    @case('Auteur')
                                                        <span class="badge bg-success ms-1">Auteur</span>
                                                        @break
                                                    @case('Lecteur')
                                                        <span class="badge bg-secondary ms-1">Lecteur</span>
                                                        @break
                                                    @default
                                                        {{-- Pas de badge pour autres --}}
                                                @endswitch
                                            @endif
                                        </div>
                                        <div class="comment-date">
                                            {{ \Carbon\Carbon::parse($commentaire->created_at ?? $commentaire->date ?? now())->format('d/m/Y à H:i') }}
                                            @if($commentaire->note && $commentaire->note > 0)
                                                <span class="ms-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $commentaire->note ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor>
                                                    <small class="text-muted ms-1">({{ $commentaire->note }}/5)</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="comment-content">
                                    {{ $commentaire->texte }}
                                </div>
                               
                                <div class="comment-actions">
                                    <span class="comment-action">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span>Utile</span>
                                    </span>
                                    <span class="comment-action">
                                        <i class="fas fa-reply"></i>
                                        <span>Répondre</span>
                                    </span>
                                <!-- @auth
                                        @if(auth()->id() === $commentaire->id_user || auth()->user()->role->nom === 'Administrateur' || auth()->user()->role->nom === 'Modérateur')
                                            <span class="comment-action text-danger" onclick="confirmDelete({{ $commentaire->id }})">
                                                <i class="fas fa-trash"></i>
                                                <span>Supprimer</span>
                                            </span>
                                        @endif
                                    @endauth -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                       
                        <!-- Pagination des commentaires -->
                        @if($commentaires->hasPages())
                        <div class="mt-4">
                            {{ $commentaires->links('pagination::bootstrap-4') }}
                        </div>
                        @endif
                    @else
                        <div class="no-comments">
                            <i class="far fa-comments"></i>
                            <h4>Aucun commentaire pour le moment</h4>
                            <p>Soyez le premier à partager votre avis sur ce contenu culturel.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Bouton de retour -->
            <div class="back-button-container">
                <a href="{{ route('contenustous') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i> Retour à la liste des contenus
                </a>
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
        // Formatage des liens dans le texte
        document.addEventListener('DOMContentLoaded', function() {
            const contenuText = document.querySelector('.contenu-text');
            if (contenuText) {
                const text = contenuText.innerHTML;
                const urlRegex = /(https?:\/\/[^\s]+)/g;
                contenuText.innerHTML = text.replace(urlRegex, function(url) {
                    return '<a href="' + url + '" target="_blank" rel="noopener noreferrer" class="text-primary">' + url + '</a>';
                });
            }
            // Gestion du formulaire de commentaire
            const commentForm = document.getElementById('commentForm');
            if (commentForm) {
                commentForm.addEventListener('submit', function(e) {
                    const commentTextarea = this.querySelector('textarea[name="texte"]');
                    if (commentTextarea.value.trim().length < 5) {
                        e.preventDefault();
                        alert('Veuillez écrire un commentaire d\'au moins 5 caractères.');
                        commentTextarea.focus();
                    }
                });
            }
            // Animation pour les actions de commentaires
            document.querySelectorAll('.comment-action').forEach(action => {
                action.addEventListener('click', function() {
                    if (this.querySelector('.fa-thumbs-up')) {
                        this.classList.toggle('text-primary');
                        const icon = this.querySelector('i');
                        if (icon.classList.contains('fa-thumbs-up')) {
                            icon.classList.replace('fa-thumbs-up', 'fa-thumbs-up');
                        }
                    }
                });
            });
            // Confirmation de suppression
            function confirmDelete(id) {
                if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
                    // Adapte à ta route destroy (ex. POST ou DELETE)
                    fetch(`/commentaires/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    }).then(response => {
                        if (response.ok) {
                            location.reload(); // Recharge pour masquer
                        } else {
                            alert('Erreur lors de la suppression.');
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>