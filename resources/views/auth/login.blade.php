<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Culture Bénin</title>
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

        .login-container {
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container::before {
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

        .login-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
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

        .login-form {
            padding: 2.5rem 2rem;
            background: white;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
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

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        .remember-me label {
            color: var(--text-dark);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-login {
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
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login::before {
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

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, var(--dark-green), var(--primary-color));
        }

        .auth-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }

        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.9rem;
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

        .status-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            background: var(--soft-green);
            border: 1px solid var(--primary-color);
            color: var(--dark-green);
            font-weight: 500;
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
            .login-container {
                padding: 1rem;
            }

            .card-header {
                padding: 2rem 1.5rem;
            }

            .login-form {
                padding: 2rem 1.5rem;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }

            .auth-links {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <h1>
                    <img src="{{ asset('images/culture.jpg') }}" alt="Logo Culture Bénin" class="logo-image">
                    Culture Bénin
                </h1>
                <p>Connectez-vous à votre compte</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Session Status -->
                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="votre@email.com">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i>Mot de passe
                    </label>
                    <div class="password-container">
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>Se connecter
                </button>

                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                    <a href="{{ route('register') }}">
                        Créer un compte
                    </a>
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