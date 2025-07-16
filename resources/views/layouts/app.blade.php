<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Mis XV Años') }} XV's Marlu</title>
    
    <!-- Meta tags for social sharing -->
    <meta property="og:title" content="Mis XV Años - Marlu">
    <meta property="og:description" content="Te invito a celebrar conmigo este momento tan especial. 15 de Agosto 2025">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <span class="logo-text">MARLU</span>
            </a>
            <button class="nav-toggle" id="navToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li class="nav-item">
                    <a href="#home" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="#countdown" class="nav-link">Cuenta Regresiva</a>
                </li>
                <li class="nav-item">
                    <a href="#invitation" class="nav-link">Invitación</a>
                </li>
                <li class="nav-item">
                    <a href="#locations" class="nav-link">Lugares</a>
                </li>
                <li class="nav-item">
                    <a href="#gallery" class="nav-link">Galería</a>
                </li>
                <li class="nav-item">
                    <a href="#hotels" class="nav-link">Regalos</a>
                </li>
                <li class="nav-item">
                    <a href="#rsvp" class="nav-link">Confirmar</a>
                </li>

            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
    
    <style>
        /* Navigation Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .nav-logo {
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #e870b8;
            letter-spacing: 2px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 30px;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #e870b8;
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #f89ad2;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .bar {
            width: 25px;
            height: 3px;
            background: #333;
            margin: 3px 0;
            transition: 0.3s;
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            background: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            z-index: 2000;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive Navigation */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background: white;
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
                padding: 20px 0;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-toggle {
                display: flex;
            }

            .nav-toggle.active .bar:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .nav-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }

            .nav-toggle.active .bar:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }
        }

        /* Loading Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader-inner {
            width: 60px;
            height: 60px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #e870b8;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Playfair Display', serif;
    color: #333;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Hero Section */
.hero-section {
    height: 100vh;
    position: relative;
    background: url('/images/hero-bg.jpg') center 10% / cover;  /* Changed from center/cover */
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-content {
    text-align: center;
    color: white;
    z-index: 1;
}

.hero-title {
    font-size: 4rem;
    margin-bottom: 1rem;
    font-weight: 300;
    letter-spacing: 3px;
}

.hero-subtitle {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: 400;
}

.hero-date {
    font-size: 1.5rem;
    font-weight: 300;
}

.scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    40% {
        transform: translateX(-50%) translateY(-20px);
    }
    60% {
        transform: translateX(-50%) translateY(-10px);
    }
}

/* Animations */
.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.3s backwards;
}

.animate-fade-in-delay-2 {
    animation: fadeIn 1s ease-out 0.6s backwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Section Styles */
.section-title {
    font-size: 3rem;
    text-align: center;
    margin-bottom: 3rem;
    color: #e870b8;
    font-weight: 400;
}

/* Countdown Section */
.countdown-section {
    padding: 80px 0;
    background: #f8f8f8;
}

.countdown-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}

.countdown-item {
    text-align: center;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    min-width: 120px;
}

.countdown-number {
    display: block;
    font-size: 3rem;
    color: #e870b8;
    font-weight: 700;
}

.countdown-label {
    display: block;
    margin-top: 10px;
    color: #666;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Invitation Section */
.invitation-section {
    padding: 80px 0;
    background: white;
}

.invitation-card {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    padding: 60px;
    background: #fafafa;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
}

.invitation-title {
    font-size: 2.5rem;
    margin-bottom: 2rem;
    color: #e870b8;
}

.invitation-text {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #666;
    margin-bottom: 3rem;
}

.invitation-details {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
    color: #333;
}

.detail-item i {
    color: #e870b8;
    font-size: 1.5rem;
}

/* Locations Section */
.locations-section {
    padding: 80px 0;
    background: #f8f8f8;
}

.locations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
    max-width: 900px;
    margin: 0 auto;
}

.location-card {
    background: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.location-card:hover {
    transform: translateY(-10px);
}

.location-icon {
    font-size: 3rem;
    color: #e870b8;
    margin-bottom: 20px;
}

.location-card h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #333;
}

.location-time {
    font-size: 1.2rem;
    color: #e870b8;
    margin-bottom: 20px;
}

.location-address {
    color: #666;
    line-height: 1.6;
    margin-bottom: 30px;
}

.location-btn {
    display: inline-block;
    padding: 12px 30px;
    background: #e870b8;
    color: white;
    text-decoration: none;
    border-radius: 25px;
    transition: background 0.3s ease;
}

.location-btn:hover {
    background: #f89ad2;
}

/* Dress Code Section */
.dress-code-section {
    padding: 80px 0;
    background: white;
}

.dress-code-content {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.dress-code-icon {
    font-size: 4rem;
    color: #e870b8;
    margin-bottom: 30px;
}

.dress-code-text {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
}

.dress-code-note {
    font-size: 1.1rem;
    color: #666;
    padding: 20px;
    background: #f8f8f8;
    border-radius: 10px;
    line-height: 1.6;
}

/* Gallery Section */
.gallery-section {
    padding: 80px 0;
    background: #f8f8f8;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    height: 300px;
    cursor: pointer;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

/* RSVP Section */
.rsvp-section {
    padding: 80px 0;
    background: white;
}

.rsvp-form {
    max-width: 600px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 25px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 15px;
    font-size: 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    transition: border-color 0.3s ease;
    font-family: inherit;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #e870b8;
}

.rsvp-btn {
    width: 100%;
    padding: 18px;
    font-size: 1.2rem;
    background: #e870b8;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-family: inherit;
}

.rsvp-btn:hover {
    background: #f89ad2;
}

.rsvp-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Hotels Section */
.hotels-section {
    padding: 80px 0;
    background: #f8f8f8;
}

.hotels-intro {
    text-align: center;
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 40px;
}

.hotels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1000px;
    margin: 0 auto;
}

.hotel-card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.hotel-card h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

.hotel-card p {
    color: #666;
    margin-bottom: 15px;
}

.hotel-phone {
    color: #e870b8;
    font-weight: 500;
}

/* Footer */
.footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 40px 0;
}

.footer p {
    margin: 5px 0;
}

/* Music Player */
.music-player {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
}

.music-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #e870b8;
    color: white;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.music-toggle:hover {
    transform: scale(1.1);
    background: #f89ad2;
}

.music-toggle.playing {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(212, 165, 116, 0.7);
    }
    70% {
        box-shadow: 0 0 0 20px rgba(212, 165, 116, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(212, 165, 116, 0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .countdown-item {
        min-width: 100px;
        padding: 20px;
    }
    
    .countdown-number {
        font-size: 2rem;
    }
    
    .invitation-card {
        padding: 40px 20px;
    }
    
    .locations-grid {
        grid-template-columns: 1fr;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
    }
}

/* Print Styles */
@media print {
    .navbar,
    .music-player,
    .rsvp-section,
    .scroll-indicator {
        display: none !important;
    }
    
    .hero-section {
        height: auto;
        padding: 50px 0;
    }
    
    section {
        page-break-inside: avoid;
    }
}

    </style>

    <script>
        // Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const navMenu = document.getElementById('navMenu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Page loader
        window.addEventListener('load', () => {
            const loader = document.createElement('div');
            loader.className = 'loader';
            loader.innerHTML = '<div class="loader-inner"></div>';
            document.body.appendChild(loader);
            
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }, 1000);
        });
    </script>
</body>
</html>