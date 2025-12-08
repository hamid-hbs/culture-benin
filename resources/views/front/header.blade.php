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

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* NAVIGATION */
        .navbar-custom {
            background: var(--white) !important;
            padding: 0.8rem 0 !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.4s ease;
        }

        .navbar-brand-custom {
            color: var(--primary-color) !important;
            font-weight: 800;
            font-size: 1.5rem !important;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .nav-link-custom {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.6rem 1rem !important;
            border-radius: 25px;
            margin: 0 0.2rem;
        }

        .nav-link-custom:hover {
            color: var(--primary-color) !important;
            background: rgba(16, 185, 129, 0.08);
        }

        .nav-link-custom.active {
            color: var(--primary-color) !important;
            background: rgba(16, 185, 129, 0.12);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .btn-nav-custom {
            font-weight: 600;
            padding: 0.6rem 1.5rem !important;
            border-radius: 25px;
            transition: 0.3s;
        }

        .btn-outline-nav {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-solid-nav {
            background: var(--primary-color);
            color: var(--white);
            border: 2px solid var(--primary-color);
        }

        section[id] {
            scroll-margin-top: 90px;
        }
    </style>
</head>

<body>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <a class="navbar-brand navbar-brand-custom" href="{{ url('/') }}">
            <img src="{{ asset('images/culture.jpg') }}" alt="Logo Culture Bénin" class="logo-image">
            Culture Bénin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto">

                <!-- Accueil -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/#accueil') }}">Accueil</a>
                </li>

                <!-- Mission -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom"
                       href="{{ url('/#mission') }}">Mission</a>
                </li>

                <!-- Contenus -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom"
                       href="{{ url('/#contenus') }}">Contenus</a>
                </li>

                <!-- Communauté -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom"
                       href="{{ url('/#communaute') }}">Communauté</a>
                </li>

            </ul>

            <!-- Auth -->
            <div class="d-flex">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-nav btn-nav-custom">S'inscrire</a>
                    <a href="{{ route('login') }}" class="btn btn-solid-nav btn-nav-custom ms-2">Se connecter</a>
                @else
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-nav btn-nav-custom" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter?');">Déconnexion</button>
                    </form>
                    <span class="navbar-text ms-2">{{ auth()->user()->name }}</span>
                @endguest
            </div>

        </div>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Active automatiquement les liens basés sur les ancres uniquement sur la page d'accueil
    document.addEventListener('DOMContentLoaded', function() {

        @if(request()->is('/'))
        const navLinks = document.querySelectorAll('.nav-link-custom');
        const sections = document.querySelectorAll('section[id]');

        function updateActiveLink() {
            let current = '';
            sections.forEach(section => {
                if (window.scrollY >= section.offsetTop - 200) {
                    current = section.id;
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === "/#" + current) {
                    link.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', updateActiveLink);
        updateActiveLink();
        @endif

    });
</script>

</body>
</html>
