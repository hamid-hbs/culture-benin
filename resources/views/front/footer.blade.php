<!DOCTYPE html>
<head>
<style>
/* Styles pour le footer */
footer {
    background: linear-gradient(135deg, #1e5631 0%, #2c3e50 100%);
    color: white;
    padding: 5rem 0 2rem;
    margin-top: 4rem;
}

.footer-links h5 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
    font-weight: 700;
    font-size: 1.3rem;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.footer-links a:hover {
    color: var(--secondary-color);
    transform: translateX(5px);
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    margin-right: 15px;
    color: white;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 1.2rem;
}

.social-icons a:hover {
    background: var(--secondary-color);
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.copyright {
    text-align: center;
    margin-top: 4rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: #95a5a6;
    font-size: 0.9rem;
}
</style>
</head>
<body>
<footer id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-links">
                <h5>Culture Bénin</h5>
                <p style="color: #bdc3c7; line-height: 1.6; font-size: 1.1rem;">Plateforme participative pour la préservation et la valorisation du patrimoine culturel et linguistique béninois.</p>
                <div class="social-icons mt-4">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-2 footer-links">
                <h5>Navigation</h5>
                <ul>
                    <li><a href="/#accueil">Accueil</a></li>
                    <li><a href="/#mission">Mission</a></li>
                    <li><a href="/#contenus">Contenus</a></li>
                    <li><a href="/#communaute">Communauté</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-links">
                <h5>Ressources</h5>
                <ul>
                    <li><a href="#">Archives Numériques</a></li>
                    <li><a href="#">Bibliothèque</a></li>
                    <li><a href="#">Recherches</a></li>
                    <li><a href="#">Publications</a></li>
                    <li><a href="#">Guides Pratiques</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-links">
                <h5>Contact</h5>
                <ul>
                    <li><i class="fas fa-map-marker-alt me-2"></i> Cotonou, Bénin</li>
                    <li><i class="fas fa-phone me-2"></i> +229 01 91 86 39 75</li>
                    <li><i class="fas fa-envelope me-2"></i> contact@culturebenin.bj</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Culture Bénin. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>
</html>