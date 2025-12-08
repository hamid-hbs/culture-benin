<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Culture Bénin</title>
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
            min-height: 100vh;
        }

        .register-container {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(16, 185, 129, 0.3) 0%, 
                rgba(52, 211, 153, 0.2) 50%,
                rgba(5, 150, 105, 0.4) 100%);
            z-index: 1;
        }

        .register-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            animation: fadeInUp 0.8s ease-out;
        }

        .card-header {
            background: linear-gradient(135deg, 
                rgba(16, 185, 129, 0.9) 0%, 
                rgba(52, 211, 153, 0.8) 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .card-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 1rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .logo-image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .register-form {
            padding: 2.5rem 2rem;
            background: white;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--primary-color);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            color: var(--text-dark);
        }

        .form-input::placeholder {
            color: var(--text-light);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            background: white;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            padding: 0.25rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
            font-weight: 500;
        }

        .btn-register {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.2), 
                transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, var(--dark-green), var(--primary-color));
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }

        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .auth-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .auth-links a:hover {
            color: var(--dark-green);
        }

        .auth-links a:hover::after {
            width: 100%;
        }

        .footer {
            text-align: center;
            padding: 1.5rem 2rem;
            color: var(--text-light);
            font-size: 0.85rem;
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .register-container {
                padding: 1rem;
            }

            .card-header {
                padding: 2rem 1.5rem;
            }

            .register-form {
                padding: 2rem 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="card-header">
                <h1>
                    <img src="{{ asset('images/culture.jpg') }}" alt="Logo Culture Bénin" class="logo-image">
                    Culture Bénin
                </h1>
                <p>Rejoignez notre communauté Culture Bénin</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf

                <div class="form-row">
                    <!-- Nom -->
                    <div class="form-group">
                        <label class="form-label" for="nom">
                            <i class="fas fa-user"></i>Nom
                        </label>
                        <input id="nom" class="form-input" type="text" name="nom" value="{{ old('nom') }}" required autofocus placeholder="Votre nom">
                        @error('nom')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label class="form-label" for="prenom">
                            <i class="fas fa-user"></i>Prénom
                        </label>
                        <input id="prenom" class="form-input" type="text" name="prenom" value="{{ old('prenom') }}" required placeholder="Votre prénom">
                        @error('prenom')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                        <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required placeholder="votre@email.com">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label class="form-label" for="mot_de_passe">
                            <i class="fas fa-lock"></i>Mot de passe
                        </label>
                        <div class="password-container">
                            <input id="mot_de_passe" class="form-input" type="password" name="mot_de_passe" required autocomplete="new-password" placeholder="••••••••">
                            <button type="button" class="password-toggle" onclick="togglePassword('mot_de_passe')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('mot_de_passe')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="form-group">
                        <label class="form-label" for="mot_de_passe_confirmation">
                            <i class="fas fa-lock"></i>Confirmation
                        </label>
                        <div class="password-container">
                            <input id="mot_de_passe_confirmation" class="form-input" type="password" name="mot_de_passe_confirmation" required placeholder="••••••••">
                            <button type="button" class="password-toggle" onclick="togglePassword('mot_de_passe_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('mot_de_passe_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i>Créer mon compte
                </button>

                <div class="auth-links">
                    Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous ici</a>
                </div>
            </form>

            
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Animation pour les erreurs
        document.addEventListener('DOMContentLoaded', function() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(error => {
                if (error.textContent.trim() !== '') {
                    error.parentElement.querySelector('.form-input').style.borderColor = '#dc2626';
                }
            });

            // Réinitialiser la couleur des bordures lors de la saisie
            document.querySelectorAll('.form-input').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.style.borderColor === 'rgb(220, 38, 38)') {
                        this.style.borderColor = '#e5e7eb';
                    }
                });
            });
        });
    </script>
</body>
</html>