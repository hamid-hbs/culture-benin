<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification 2FA - Culture Bénin</title>
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
            text-align: center;
            letter-spacing: 0.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .form-input::placeholder {
            color: var(--text-light);
            letter-spacing: normal;
            font-weight: normal;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            background: white;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
            font-weight: 500;
        }

        .btn-verify {
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

        .btn-verify::before {
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

        .btn-verify:hover::before {
            left: 100%;
        }

        .btn-verify:hover {
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

        .info-section {
            background: var(--soft-green);
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .info-section h2 {
            color: var(--dark-green);
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-section p {
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .info-section strong {
            color: var(--dark-green);
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

        .btn-resend {
            background: none;
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .btn-resend:hover {
            color: var(--dark-green);
            background: rgba(16, 185, 129, 0.1);
        }

        .btn-logout {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: underline;
        }

        .btn-logout:hover {
            color: var(--text-dark);
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

            .form-input {
                font-size: 1.1rem;
                letter-spacing: 0.3rem;
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
                <p>Vérification à deux facteurs</p>
            </div>

            <form method="POST" action="{{ route('two-factor.verify') }}" class="login-form">
                @csrf

                <div class="info-section">
                    <h2><i class="fas fa-shield-alt"></i>Sécurité du compte</h2>
                    <p>
                        Pour accéder à votre compte, veuillez saisir le code de vérification à 6 chiffres 
                        généré par votre application d'authentification.
                    </p>
                    <p>
                        <strong>Utilisateur :</strong> {{ Auth::user()->email }}
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="status-message">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

                <!-- Verification Code -->
                <div class="form-group">
                    <label class="form-label" for="two_factor_code">
                        <i class="fas fa-key"></i>Code de vérification
                    </label>
                    <input 
                        id="two_factor_code" 
                        class="form-input" 
                        type="text" 
                        name="two_factor_code" 
                        required 
                        autofocus 
                        autocomplete="one-time-code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        title="Veuillez entrer un code à 6 chiffres"
                        placeholder="000000"
                        inputmode="numeric"
                    >
                    @error('two_factor_code')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-verify">
                    <i class="fas fa-check-circle"></i>Vérifier le code
                </button>

                <div class="auth-links">
                    <button 
                        type="button"
                        onclick="event.preventDefault(); document.getElementById('resend-form').submit();"
                        class="btn-resend"
                    >
                        <i class="fas fa-redo"></i>Renvoyer le code
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i>Se déconnecter
                        </button>
                    </form>
                </div>
            </form>

            <form id="resend-form" method="POST" action="{{ route('two-factor.send') }}" class="hidden">
                @csrf
            </form>
        </div>
    </div>

    <script>
        // Auto-format du code 2FA
        document.getElementById('two_factor_code').addEventListener('input', function(e) {
            // Supprimer tous les caractères non numériques
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limiter à 6 chiffres
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });

        // Auto-soumettre quand 6 chiffres sont saisis
        document.getElementById('two_factor_code').addEventListener('input', function(e) {
            if (this.value.length === 6) {
                this.form.submit();
            }
        });

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

        // Focus automatique sur le champ de code
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('two_factor_code').focus();
        });
    </script>
</body>
</html>