<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Almacenamiento en la Nube</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero-section">
        <nav class="navbar animate__animated animate__fadeInDown">
            <div class="logo">
                <i class="fas fa-cloud"></i>
                <span><?php echo SITE_NAME; ?></span>
            </div>
            <div class="nav-links">
                <a href="#features" class="nav-link">Características</a>
                <a href="#pricing" class="nav-link">Planes</a>
                <a href="login.php" class="nav-link">Iniciar Sesión</a>
                <a href="register.php" class="btn-primary">Registrarse</a>
            </div>
        </nav>

        <div class="hero-content animate__animated animate__fadeIn">
            <h1>Almacena, comparte y accede a tus archivos desde cualquier lugar</h1>
            <p class="subtitle">Tu nube personal segura y confiable con hasta 1GB de almacenamiento gratuito.</p>
            <div class="cta-buttons">
                <a href="register.php" class="btn-primary btn-large">Empieza ahora - Es gratis</a>
                <a href="#features" class="btn-secondary btn-large"><i class="fas fa-play-circle"></i> Ver demo</a>
            </div>
        </div>

        <div class="hero-image animate__animated animate__fadeInUp">
            <img src="assets/img/cloud-storage.png" alt="Almacenamiento en la nube">
        </div>
    </div>

    <section id="features" class="features-section">
        <h2 class="section-title">Características poderosas</h2>
        <div class="features-grid">
            <div class="feature-card animate__animated animate__fadeInLeft">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Seguridad avanzada</h3>
                <p>Tus archivos están protegidos con encriptación y acceso seguro.</p>
            </div>
            <div class="feature-card animate__animated animate__fadeInUp">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Acceso multiplataforma</h3>
                <p>Accede a tus archivos desde cualquier dispositivo con conexión a internet.</p>
            </div>
            <div class="feature-card animate__animated animate__fadeInRight">
                <div class="feature-icon">
                    <i class="fas fa-share-alt"></i>
                </div>
                <h3>Comparte fácilmente</h3>
                <p>Comparte archivos con otros usuarios mediante enlaces temporales.</p>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing-section">
        <h2 class="section-title">Planes simples</h2>
        <div class="pricing-grid">
            <div class="pricing-card animate__animated animate__fadeInLeft">
                <h3>Básico</h3>
                <div class="price">$0<span>/mes</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check"></i> 1GB de almacenamiento</li>
                    <li><i class="fas fa-check"></i> Subida de archivos hasta 100MB</li>
                    <li><i class="fas fa-check"></i> Acceso desde cualquier dispositivo</li>
                    <li><i class="fas fa-check"></i> Compartir archivos</li>
                </ul>
                <a href="register.php" class="btn-primary">Elegir plan</a>
            </div>
            <div class="pricing-card featured animate__animated animate__fadeInUp">
                <div class="popular-badge">Popular</div>
                <h3>Premium</h3>
                <div class="price">$4.99<span>/mes</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check"></i> 50GB de almacenamiento</li>
                    <li><i class="fas fa-check"></i> Subida de archivos hasta 2GB</li>
                    <li><i class="fas fa-check"></i> Acceso prioritario</li>
                    <li><i class="fas fa-check"></i> Enlaces de descarga privados</li>
                    <li><i class="fas fa-check"></i> Soporte prioritario</li>
                </ul>
                <a href="register.php" class="btn-primary">Elegir plan</a>
            </div>
            <div class="pricing-card animate__animated animate__fadeInRight">
                <h3>Empresarial</h3>
                <div class="price">$9.99<span>/mes</span></div>
                <ul class="features-list">
                    <li><i class="fas fa-check"></i> 200GB de almacenamiento</li>
                    <li><i class="fas fa-check"></i> Subida de archivos hasta 5GB</li>
                    <li><i class="fas fa-check"></i> Usuarios ilimitados</li>
                    <li><i class="fas fa-check"></i> Estadísticas avanzadas</li>
                    <li><i class="fas fa-check"></i> Soporte 24/7</li>
                </ul>
                <a href="register.php" class="btn-primary">Elegir plan</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-cloud"></i>
                <span><?php echo SITE_NAME; ?></span>
            </div>
            <div class="footer-links">
                <a href="#">Términos de servicio</a>
                <a href="#">Privacidad</a>
                <a href="#">Contacto</a>
                <a href="#">Soporte</a>
            </div>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <div class="copyright">
            &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Todos los derechos reservados.
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>