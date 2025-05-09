document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.toggle('active');
        this.querySelector('i').classList.toggle('fa-times');
        this.querySelector('i').classList.toggle('fa-bars');
    });
    
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Close mobile menu if open
                navLinks.classList.remove('active');
                mobileMenuBtn.querySelector('i').classList.remove('fa-times');
                mobileMenuBtn.querySelector('i').classList.add('fa-bars');
                
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Video modal functionality
    const videoBtn = document.querySelector('.video-btn');
    const videoModal = document.querySelector('.video-modal');
    const closeModal = document.querySelector('.close-modal');
    const videoIframe = document.getElementById('video-iframe');
    
    if (videoBtn) {
        videoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            videoModal.style.display = 'flex';
            videoIframe.src = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1'; // Replace with your video URL
            document.body.style.overflow = 'hidden';
        });
    }
    
    closeModal.addEventListener('click', function() {
        videoModal.style.display = 'none';
        videoIframe.src = '';
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking outside
    videoModal.addEventListener('click', function(e) {
        if (e.target === videoModal) {
            videoModal.style.display = 'none';
            videoIframe.src = '';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Pricing switcher - Versión mejorada
    const billingToggle = document.getElementById('billing-toggle');
    const monthlyText = document.querySelector('.pricing-switcher span:first-child');
    const yearlyText = document.querySelector('.pricing-switcher span:last-child');
    const prices = document.querySelectorAll('.price');
    const pricingCards = document.querySelectorAll('.pricing-card');

    if (billingToggle) {
        billingToggle.addEventListener('change', function() {
            // Animación de transición
            pricingCards.forEach(card => {
                card.style.transform = 'scale(0.98)';
                card.style.opacity = '0.8';
                card.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    card.style.transform = '';
                    card.style.opacity = '';
                }, 300);
            });

            if (this.checked) {
                monthlyText.classList.remove('active');
                yearlyText.classList.add('active');
                
                // Update prices for yearly billing (with discount)
                prices.forEach(price => {
                    const currentPrice = parseFloat(price.textContent.replace('$', ''));
                    const yearlyPrice = (currentPrice * 12 * 0.8).toFixed(2); // 20% discount
                    
                    // Efecto de conteo animado
                    const startValue = currentPrice;
                    const endValue = yearlyPrice;
                    const duration = 800;
                    let startTimestamp = null;
                    
                    const animatePrice = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        const value = progress * (endValue - startValue) + startValue;
                        price.innerHTML = `<span class="currency">$</span>${value.toFixed(3)}<span class="period">/año</span>`;
                        
                        if (progress < 1) {
                            window.requestAnimationFrame(animatePrice);
                        }
                    };
                    
                    window.requestAnimationFrame(animatePrice);
                });
            } else {
                yearlyText.classList.remove('active');
                monthlyText.classList.add('active');
                
                // Revert to monthly prices
                const monthlyPrices = {
                    'Básico': '0',
                    'Premium': '20.000',
                    'Empresarial': '50.000'
                };
                
                prices.forEach(price => {
                    const plan = price.closest('.pricing-card').querySelector('h3').textContent;
                    
                    // Efecto de conteo animado para volver a los precios mensuales
                    const startValue = parseFloat(price.textContent.replace('$', ''));
                    const endValue = parseFloat(monthlyPrices[plan]);
                    const duration = 800;
                    let startTimestamp = null;
                    
                    const animatePrice = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        const value = progress * (endValue - startValue) + startValue;
                        price.innerHTML = `<span class="currency">$</span>${value.toFixed(3)}<span class="period">/mes</span>`;
                        
                        if (progress < 1) {
                            window.requestAnimationFrame(animatePrice);
                        }
                    };
                    
                    window.requestAnimationFrame(animatePrice);
                });
            }
        });
    }

    // Efecto hover mejorado para las tarjetas
    pricingCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transition = 'all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)';
        });
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Testimonials Slider
        const testimonialsSlider = new Swiper('.testimonials-slider', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 40,
            centeredSlides: true,
            autoplay: {
                delay: 8000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                }
            },
            on: {
                init: function() {
                    // Add active class to first slide
                    this.slides[this.activeIndex].classList.add('swiper-slide-active');
                },
                slideChange: function() {
                    // Remove active class from all slides
                    this.slides.forEach(slide => {
                        slide.classList.remove('swiper-slide-active');
                    });
                    // Add active class to current slide
                    this.slides[this.activeIndex].classList.add('swiper-slide-active');
                }
            }
        });
    
        // Pause autoplay on hover
        const testimonialsContainer = document.querySelector('.testimonials-container');
        if (testimonialsContainer) {
            testimonialsContainer.addEventListener('mouseenter', function() {
                testimonialsSlider.autoplay.stop();
            });
            
            testimonialsContainer.addEventListener('mouseleave', function() {
                testimonialsSlider.autoplay.start();
            });
        }
    
        // Partners Slider
        const partnersSlider = new Swiper('.partners-slider', {
            loop: true,
            slidesPerView: 2,
            spaceBetween: 20,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                992: {
                    slidesPerView: 5,
                    spaceBetween: 50,
                },
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 60,
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de desplazamiento infinito mejorado
            const partnersTrack = document.querySelector('.partners-track');
            
            if (partnersTrack) {
                // Duplicar los logos para efecto continuo
                const originalContent = partnersTrack.innerHTML;
                partnersTrack.innerHTML = originalContent + originalContent;
                
                // Pausar animación al hacer hover
                partnersTrack.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                partnersTrack.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'running';
                });
                
                // Ajustar velocidad según el ancho
                function adjustSpeed() {
                    const trackWidth = partnersTrack.scrollWidth / 2;
                    const containerWidth = partnersTrack.parentElement.offsetWidth;
                    const duration = Math.max(20, trackWidth / 100); // Ajustar según necesidad
                    partnersTrack.style.animationDuration = `${duration}s`;
                }
                
                // Inicializar y ajustar en resize
                adjustSpeed();
                window.addEventListener('resize', adjustSpeed);
            }
            
            // Efecto de aparición suave
            const partnerItems = document.querySelectorAll('.partner-item');
            partnerItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 500 + index * 50);
            });
        });
    
        // Animate elements on scroll
        const animateOnScroll = function() {
            const testimonialCards = document.querySelectorAll('.testimonial-card');
            
            testimonialCards.forEach((card, index) => {
                const cardPosition = card.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.3;
                
                if (cardPosition < screenPosition) {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 150);
                }
            });
        };
    
        // Set initial state
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });
    
        // Run on load and scroll
        window.addEventListener('load', animateOnScroll);
        window.addEventListener('scroll', animateOnScroll);
    });
    
    // Animate elements when they come into view
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('[data-aos]');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (elementPosition < screenPosition) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };
    
    // Initialize elements with opacity 0 and transform
    document.querySelectorAll('[data-aos="fade-up"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    document.querySelectorAll('[data-aos="fade-down"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(-20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    document.querySelectorAll('[data-aos="fade-left"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateX(-20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    document.querySelectorAll('[data-aos="fade-right"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateX(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    document.querySelectorAll('[data-aos="zoom-in"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'scale(0.9)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run on page load
    
    // Floating particles background
    if (document.getElementById('particles-js')) {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#4361ee"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#4361ee",
                    "opacity": 0.2,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Animaciones GSAP mejoradas
        if (typeof gsap !== 'undefined') {
            // Animación del hero completo
            const heroTimeline = gsap.timeline();
            
            heroTimeline
                .from('.hero-badge', {
                    y: -30,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'back.out'
                })
                .from('.hero-content h1', {
                    y: 50,
                    opacity: 0,
                    duration: 1,
                    ease: 'power3.out'
                }, '-=0.6')
                .from('.hero-stats', {
                    y: 40,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power2.out'
                }, '-=0.8')
                .from('.hero-content .subtitle', {
                    y: 40,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.7')
                .from('.cta-buttons', {
                    y: 40,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.6')
                .from('.trust-badges', {
                    y: 40,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'power3.out'
                }, '-=0.5')
                .from('.hero-image', {
                    x: 100,
                    opacity: 0,
                    duration: 1.2,
                    ease: 'power3.out'
                }, '-=1.2')
                .from('.image-badge', {
                    scale: 0,
                    opacity: 0,
                    duration: 0.6,
                    stagger: 0.2,
                    ease: 'back.out'
                }, '-=0.8');
    
            // Efecto flotante para la imagen
            gsap.to('.floating', {
                y: 20,
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut'
            });
    
            // Efecto pulso para el botón principal
            gsap.to('.pulse-effect', {
                scale: 1.03,
                duration: 1.5,
                repeat: -1,
                yoyo: true,
                ease: 'power1.inOut'
            });
    
            // Efecto hover para los badges
            gsap.utils.toArray('.badge-item').forEach(badge => {
                badge.addEventListener('mouseenter', () => {
                    gsap.to(badge, {
                        y: -5,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
                badge.addEventListener('mouseleave', () => {
                    gsap.to(badge, {
                        y: 0,
                        duration: 0.3,
                        ease: 'power2.out'
                    });
                });
            });
        }
    
        // Intersection Observer para animaciones
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.1 });
    
            observer.observe(heroContent);
        }
    });
});