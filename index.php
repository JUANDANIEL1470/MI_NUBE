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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero-section">
        <div class="particles" id="particles-js"></div>
        <nav class="navbar animate__animated animate__fadeInDown">
            <div class="logo">
                <img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?>" class="logo-img">
                <span><?php echo SITE_NAME; ?></span>
            </div>
            <div class="nav-links">
                <a href="#features" class="nav-link">Características</a>
                <a href="#pricing" class="nav-link">Planes</a>
                <a href="#testimonials" class="nav-link">Testimonios</a>
                <a href="login.php" class="nav-link">Iniciar Sesión</a>
                <a href="register.php" class="btn-primary pulse-effect">Registrarse</a>
            </div>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </nav>

        <div class="hero-content animate__animated animate__fadeIn">
            <div class="hero-badge" data-aos="fade-up">
                <span>✨ Plataforma líder en almacenamiento</span>
            </div>
            <h1 data-aos="fade-up" data-aos-delay="100">Transforma cómo gestionas tus archivos <span class="text-gradient">en la nube</span></h1>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="200">La solución todo-en-uno para <strong>empresas y profesionales</strong> que necesitan seguridad, velocidad y colaboración sin límites.</p>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="150">
                <div class="stat-item">
                    <span class="stat-value">+99.9%</span>
                    <span class="stat-label">Uptime</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">256-bit</span>
                    <span class="stat-label">Encriptación</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">1GB+</span>
                    <span class="stat-label">Gratis</span>
                </div>
            </div>
            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                <a href="register.php" class="btn-primary btn-large pulse-effect">
                    <span class="btn-content">
                        <span class="btn-text">Empieza ahora</span>
                        <span class="btn-subtext">Registro sin tarjeta</span>
                    </span>
                </a>
                <a href="#demo-video" class="btn-secondary btn-large video-btn">
                    <i class="fas fa-play-circle"></i>
                    <span>Ver demostración</span>
                </a>
            </div>
            <div class="trust-badges" data-aos="fade-up" data-aos-delay="400">
                <div class="badge-item">
                    <img src="assets/img/ssl-badge.svg" alt="SSL Secure" loading="lazy">
                    <span>Protegido SSL</span>
                </div>
                <div class="badge-item">
                    <img src="assets/img/users-icon.svg" alt="Usuarios" loading="lazy">
                    <span>+10K usuarios</span>
                </div>
                <div class="badge-item">
                    <img src="assets/img/globe-icon.svg" alt="Global" loading="lazy">
                    <span>Disponible mundialmente</span>
                </div>
            </div>
        </div>

        <div class="hero-image animate__animated animate__fadeInUp" data-aos="fade-left">
            <div class="image-container">
                <img src="assets/img/cloud-storage.jpg" alt="Almacenamiento en la nube seguro" loading="lazy" class="floating">
                <div class="image-badge security">
                    <i class="fas fa-shield-alt"></i>
                    <span>Protección avanzada</span>
                </div>
                <div class="image-badge sync">
                    <i class="fas fa-sync-alt"></i>
                    <span>Sincronización en tiempo real</span>
                </div>
            </div>
        </div>
    </div>

    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Características poderosas</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Descubre todo lo que nuestra plataforma puede ofrecerte</p>
            
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Seguridad avanzada</h3>
                    <p>Tus archivos están protegidos con encriptación AES-256 y acceso seguro mediante autenticación de dos factores.</p>
                    <div class="feature-wave"></div>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3>Sincronización en tiempo real</h3>
                    <p>Tus cambios se sincronizan automáticamente en todos tus dispositivos al instante.</p>
                    <div class="feature-wave"></div>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>Historial de versiones</h3>
                    <p>Accede a versiones anteriores de tus archivos hasta por 30 días con nuestro sistema de control de versiones.</p>
                    <div class="feature-wave"></div>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Acceso multiplataforma</h3>
                    <p>Accede a tus archivos desde cualquier dispositivo con conexión a internet.</p>
                    <div class="feature-wave"></div>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3>Comparte fácilmente</h3>
                    <p>Comparte archivos con otros usuarios mediante enlaces temporales y permisos personalizados.</p>
                    <div class="feature-wave"></div>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon pulse-effect">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Estadísticas avanzadas</h3>
                    <p>Visualiza el uso de tu almacenamiento y actividad reciente con nuestro panel de estadísticas.</p>
                    <div class="feature-wave"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="demo-video" class="video-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Cómo funciona <?php echo SITE_NAME; ?></h2>
            <div class="video-wrapper" data-aos="zoom-in">
                <div class="video-container">
                    <img src="assets/img/video-thumbnail.jpg" alt="Video demostrativo" class="video-thumbnail">
                    <div class="play-button pulse-effect">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing-section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Planes simples</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Elige el plan que mejor se adapte a tus necesidades</p>
            
            <div class="pricing-switcher" data-aos="fade-up" data-aos-delay="200">
                <span class="active">Mensual</span>
                <label class="switch">
                    <input type="checkbox" id="billing-toggle">
                    <span class="slider round"></span>
                </label>
                <span>Anual (20% descuento)</span>
            </div>
            
            <div class="pricing-grid">
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                    <h3>Básico</h3>
                    <div class="price"><span class="currency">$</span>0<span class="period">/mes</span></div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> 1GB de almacenamiento</li>
                        <li><i class="fas fa-check"></i> Subida de archivos hasta 100MB</li>
                        <li><i class="fas fa-check"></i> Acceso desde cualquier dispositivo</li>
                        <li><i class="fas fa-check"></i> Compartir archivos</li>
                        <li><i class="fas fa-check"></i> Soporte básico</li>
                    </ul>
                    <a href="register.php" class="btn-primary">Elegir plan</a>
                </div>
                
                <div class="pricing-card featured" data-aos="fade-up" data-aos-delay="400">
                    <div class="popular-badge">Más popular</div>
                    <h3>Premium</h3>
                    <div class="price"><span class="currency">$</span>20.000<span class="period">/mes</span></div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> 50GB de almacenamiento</li>
                        <li><i class="fas fa-check"></i> Subida de archivos hasta 2GB</li>
                        <li><i class="fas fa-check"></i> Acceso prioritario</li>
                        <li><i class="fas fa-check"></i> Enlaces de descarga privados</li>
                        <li><i class="fas fa-check"></i> Soporte prioritario</li>
                        <li><i class="fas fa-check"></i> Historial de versiones (30 días)</li>
                    </ul>
                    <a href="register.php" class="btn-primary">Elegir plan</a>
                </div>
                
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="500">
                    <h3>Empresarial</h3>
                    <div class="price"><span class="currency">$</span>50.000<span class="period">/mes</span></div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> 200GB de almacenamiento</li>
                        <li><i class="fas fa-check"></i> Subida de archivos hasta 5GB</li>
                        <li><i class="fas fa-check"></i> Usuarios ilimitados</li>
                        <li><i class="fas fa-check"></i> Estadísticas avanzadas</li>
                        <li><i class="fas fa-check"></i> Soporte 24/7</li>
                        <li><i class="fas fa-check"></i> Historial de versiones (90 días)</li>
                    </ul>
                    <a href="register.php" class="btn-primary">Elegir plan</a>
                </div>
            </div>
            
            <div class="custom-plan" data-aos="fade-up">
                <p>¿Necesitas un plan personalizado para tu empresa? <a href="#contact">Contáctanos</a> para una solución a medida.</p>
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-pre-title">Voces de nuestros clientes</span>
                <h2 class="section-title">Líderes que confían en nosotros</h2>
                <p class="section-subtitle">Empresas innovadoras que transforman su negocio con nuestra plataforma</p>
            </div>
            
            <div class="testimonials-container">
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">
                        <!-- Testimonio Elon Musk -->
                        <div class="testimonial-card swiper-slide">
                            <div class="testimonial-badge">CEO del Año</div>
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 17H3V12C3 7.029 7.029 3 12 3V7C9.239 7 7 9.239 7 12V17Z" fill="currentColor"/>
                                        <path d="M21 17H17V12C17 7.029 21.029 3 26 3V7C23.239 7 21 9.239 21 12V17Z" fill="currentColor" transform="translate(-8)"/>
                                    </svg>
                                </div>
                                <p class="testimonial-text">"Implementamos esta solución en todos nuestros equipos de Tesla y SpaceX. La escalabilidad y seguridad son incomparables. Redujimos nuestros costos de IT en un 35% el primer año."</p>
                                <div class="testimonial-stats">
                                    <div class="stat-item">
                                        <span class="stat-value">+35%</span>
                                        <span class="stat-label">Eficiencia</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-value">99.9%</span>
                                        <span class="stat-label">Uptime</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar-wrapper">
                                    <img src="assets/img/elon-musk.jpg" alt="Elon Musk" loading="lazy" class="author-avatar">
                                    <div class="author-verified">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#3B82F6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name">Elon Musk</h4>
                                    <span class="author-position">CEO, Tesla & SpaceX</span>
                                    <div class="author-social">
                                        <span>@elonmusk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Testimonio Sam Altman -->
                        <div class="testimonial-card swiper-slide">
                            <div class="testimonial-badge">Top Innovación</div>
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 17H3V12C3 7.029 7.029 3 12 3V7C9.239 7 7 9.239 7 12V17Z" fill="currentColor"/>
                                        <path d="M21 17H17V12C17 7.029 21.029 3 26 3V7C23.239 7 21 9.239 21 12V17Z" fill="currentColor" transform="translate(-8)"/>
                                    </svg>
                                </div>
                                <p class="testimonial-text">"En OpenAI necesitamos infraestructura confiable para nuestros modelos de IA. Esta plataforma ha soportado cargas de trabajo masivas sin problemas. El equipo de soporte es excepcional."</p>
                                <div class="testimonial-stats">
                                    <div class="stat-item">
                                        <span class="stat-value">10x</span>
                                        <span class="stat-label">Rendimiento</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-value">24/7</span>
                                        <span class="stat-label">Soporte</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar-wrapper">
                                    <img src="assets/img/sam-altman.jpg" alt="Sam Altman" loading="lazy" class="author-avatar">
                                    <div class="author-verified">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#3B82F6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name">Sam Altman</h4>
                                    <span class="author-position">CEO, OpenAI</span>
                                    <div class="author-social">
                                        <span>@sama</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Testimonio Jeff Bezos -->
                        <div class="testimonial-card swiper-slide">
                            <div class="testimonial-badge">Recomendado</div>
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 17H3V12C3 7.029 7.029 3 12 3V7C9.239 7 7 9.239 7 12V17Z" fill="currentColor"/>
                                        <path d="M21 17H17V12C17 7.029 21.029 3 26 3V7C23.239 7 21 9.239 21 12V17Z" fill="currentColor" transform="translate(-8)"/>
                                    </svg>
                                </div>
                                <p class="testimonial-text">"Amazon migró más de 200 equipos a esta plataforma. La integración con nuestros sistemas fue impecable. Ahora tenemos visibilidad completa de todos nuestros datos en tiempo real."</p>
                                <div class="testimonial-stats">
                                    <div class="stat-item">
                                        <span class="stat-value">200+</span>
                                        <span class="stat-label">Equipos</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-value">100%</span>
                                        <span class="stat-label">Integración</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar-wrapper">
                                    <img src="assets/img/jeff-bezos.jpg" alt="Jeff Bezos" loading="lazy" class="author-avatar">
                                    <div class="author-verified">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#3B82F6">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name">Jeff Bezos</h4>
                                    <span class="author-position">Fundador, Amazon</span>
                                    <div class="author-social">
                                        <span>@jeffbezos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paginación personalizada -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            
            <!-- Sección de Partners (horizontal) -->
            <div class="trusted-by" data-aos="fade-up">
                <p class="trusted-label">Nuestros aliados estratégicos</p>
                <div class="partners-container">
                    <div class="partners-track">
                        <!-- Primera línea de logos -->
                        <div class="partner-item">
                            <img src="assets/img/icloud-logo.png" alt="iCloud" loading="lazy">
                            <span class="partner-tooltip">Integración con iCloud</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/mega-logo.png" alt="MEGA" loading="lazy">
                            <span class="partner-tooltip">Socio de seguridad</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/google-drive-logo.png" alt="Google Drive" loading="lazy">
                            <span class="partner-tooltip">Google Cloud Partner</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/dropbox-logo.png" alt="Dropbox" loading="lazy">
                            <span class="partner-tooltip">Solución empresarial</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/aws-logo.png" alt="AWS" loading="lazy">
                            <span class="partner-tooltip">Powered by AWS</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/microsoft-logo.png" alt="Microsoft" loading="lazy">
                            <span class="partner-tooltip">Microsoft Gold Partner</span>
                        </div>
                        
                        <!-- Duplicado para efecto continuo -->
                        <div class="partner-item">
                            <img src="assets/img/icloud-logo.png" alt="iCloud" loading="lazy">
                            <span class="partner-tooltip">Integración con iCloud</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/mega-logo.png" alt="MEGA" loading="lazy">
                            <span class="partner-tooltip">Socio de seguridad</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/google-drive-logo.png" alt="Google Drive" loading="lazy">
                            <span class="partner-tooltip">Google Cloud Partner</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/dropbox-logo.png" alt="Dropbox" loading="lazy">
                            <span class="partner-tooltip">Solución empresarial</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/aws-logo.png" alt="AWS" loading="lazy">
                            <span class="partner-tooltip">Powered by AWS</span>
                        </div>
                        <div class="partner-item">
                            <img src="assets/img/microsoft-logo.png" alt="Microsoft" loading="lazy">
                            <span class="partner-tooltip">Microsoft Gold Partner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2>¿Listo para comenzar?</h2>
                <p>Regístrate ahora y obtén 1GB de almacenamiento gratuito</p>
                <a href="register.php" class="btn-primary btn-large pulse-effect">Crear cuenta gratis</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <div class="footer-logo">
                        <img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?>" class="logo-img">
                        <span><?php echo SITE_NAME; ?></span>
                    </div>
                    <p class="footer-about">La solución de almacenamiento en la nube más confiable para particulares y empresas.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>Producto</h3>
                    <ul class="footer-links">
                        <li><a href="#features">Características</a></li>
                        <li><a href="#pricing">Planes</a></li>
                        <li><a href="#demo-video">Demo</a></li>
                        <li><a href="#">Descargas</a></li>
                        <li><a href="#">Actualizaciones</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Empresa</h3>
                    <ul class="footer-links">
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Carreras</a></li>
                        <li><a href="#">Socios</a></li>
                        <li><a href="#">Prensa</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Soporte</h3>
                    <ul class="footer-links">
                        <li><a href="#">Centro de ayuda</a></li>
                        <li><a href="#">Documentación</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Estado del servicio</a></li>
                        <li><a href="#">Seguridad</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Contacto</h3>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> Calle Ejemplo 123, Ciudad</li>
                        <li><i class="fas fa-phone-alt"></i> +1 234 567 890</li>
                        <li><i class="fas fa-envelope"></i> info@<?php echo strtolower(SITE_NAME); ?>.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Todos los derechos reservados.
                </div>
                <div class="legal-links">
                    <a href="#">Términos de servicio</a>
                    <a href="#">Política de privacidad</a>
                    <a href="#">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal para el video -->
    <div class="video-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <iframe id="video-iframe" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>
    
    <script>
        // Inicializar AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Inicializar partículas
        particlesJS.load('particles-js', 'assets/js/particles.json', function() {
            console.log('Partículas cargadas');
        });
    </script>
</body>
</html>