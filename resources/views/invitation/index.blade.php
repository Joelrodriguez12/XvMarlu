@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title animate-fade-in">Mis XV Años</h1>
        <h2 class="hero-subtitle animate-fade-in-delay">{{ $birthday_girl }}</h2>
        <p class="hero-date animate-fade-in-delay-2">{{ \Carbon\Carbon::parse($event_date)->locale('es')->isoFormat('D [de] MMMM YYYY') }}</p>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Countdown Section -->
<section class="countdown-section" id="countdown">
    <div class="container">
        <h2 class="section-title">Faltan</h2>
        <div class="countdown-container" data-event-date="{{ $event_date }} {{ $ceremony_time }}">
            <div class="countdown-item">
                <span class="countdown-number" id="days">00</span>
                <span class="countdown-label">Días</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="hours">00</span>
                <span class="countdown-label">Horas</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="minutes">00</span>
                <span class="countdown-label">Minutos</span>
            </div>
            <div class="countdown-item">
                <span class="countdown-number" id="seconds">00</span>
                <span class="countdown-label">Segundos</span>
            </div>
        </div>
    </div>
</section>

<!-- Invitation Section -->
<section class="invitation-section" id="invitation">
    <div class="container">
        <div class="invitation-card">
            <h2 class="invitation-title">Te invito a celebrar conmigo</h2>
            <p class="invitation-text">
                Con gran alegría y emoción, te invito a compartir conmigo este momento tan especial en mi vida.
                Tu presencia hará que este día sea inolvidable.
            </p>
            <div class="invitation-details">
                <div class="detail-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ \Carbon\Carbon::parse($event_date)->locale('es')->isoFormat('D [de] MMMM, YYYY') }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ \Carbon\Carbon::parse($ceremony_time)->format('g:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Locations Section -->
<section class="locations-section" id="locations">
    <div class="container">
        <h2 class="section-title">Lugares</h2>
        <div class="locations-grid">
           
            <div class="location-card">
                <div class="location-icon">
                    <i class="fas fa-glass-cheers"></i>
                </div>
                <h3>Recepción</h3>
                <p class="location-time">{{ \Carbon\Carbon::parse($party_time)->format('g:i A') }}</p>
                <p class="location-address">
                    {{ $party_location['name'] }}<br>
                    {{ $party_location['address'] }}
                </p>
                <a href="{{ $party_location['maps_url'] }}" target="_blank" class="location-btn">
                    <i class="fas fa-map-marker-alt"></i> Ver en Mapa
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Dress Code Section -->
<section class="dress-code-section" id="dress-code">
    <div class="container">
        <h2 class="section-title">Código de Vestimenta</h2>
        <div class="dress-code-content">
            <div class="dress-code-icon">
                <i class="fas fa-tshirt"></i>
            </div>
            <p class="dress-code-text">
                Formal  
            </p>
            <p class="dress-code-note">
                <strong>Nota:</strong> Los colores rosa y blanco están reservados para la quinceañera.
            </p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section" id="gallery">
    <div class="container">
        <h2 class="section-title">Galería</h2>
        <div class="gallery-grid">
            @foreach($gallery_images as $image)
                <div class="gallery-item" data-image="{{ asset('images/' . $image) }}">
                    <img src="{{ asset('images/' . $image) }}" alt="XV años - {{ $birthday_girl }}">
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Hotels Section -->
<section class="hotels-section" id="hotels">
    <div class="container">
        <h2 class="section-title">Regalos</h2>
        <div class="dress-code-content">
            <div class="dress-code-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <p class="gift-note"> La modalidad de regalos sera lluvia de sobres.
            </p>
        </div>
    </div>
</section>

<!-- RSVP Section -->
<section class="rsvp-section" id="rsvp">
    <div class="container">
        <h2 class="section-title">Confirma tu Asistencia</h2>
        <form class="rsvp-form" method="POST" action="{{ route('rsvp.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Nombre completo" required value="{{ old('name') }}">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="number" name="guests" placeholder="Número de invitados" min="1" max="1" required value="{{ old('guests', 1) }}">
                @error('guests')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Mensaje (opcional)" rows="4">{{ old('message') }}</textarea>
                @error('message')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="rsvp-btn">Confirmar Asistencia</button>
        </form>
    </div>
</section>


<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>{{ $birthday_girl }} - Mis XV Años</p>
        <p>{{ \Carbon\Carbon::parse($event_date)->locale('es')->isoFormat('D [de] MMMM YYYY') }}</p>
    </div>
</footer>

<!-- Music Player -->
<div class="music-player">
    <button class="music-toggle" id="musicToggle">
        <i class="fas fa-music"></i>
    </button>
    <audio id="backgroundMusic" loop>
        <source src="{{ asset('audio/background-music.mp3') }}" type="audio/mpeg">
    </audio>
</div>

<!-- Lightbox for Gallery -->
<div class="lightbox" id="lightbox">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightboxImage">
</div>

@endsection

@push('styles')
<style>
/* Same styles as before, but add these additional styles */

/* Error Messages */
.error-message {
    color: #f44336;
    font-size: 0.9rem;
    margin-top: 5px;
    display: block;
}

/* Lightbox */
.lightbox {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    animation: fadeIn 0.3s ease;
}

.lightbox-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 900px;
    max-height: 80vh;
    object-fit: contain;
    animation: zoomIn 0.3s ease;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.lightbox-close {
    position: absolute;
    top: 30px;
    right: 45px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.lightbox-close:hover {
    color: #e870b8;
}

@keyframes zoomIn {
    from {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
    }
    to {
        transform: translate(-50%, -50%) scale(1);
        opacity: 1;
    }
}

/* All the other styles from the previous artifact go here */

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
@endpush

@push('scripts')
<script>
// Countdown Timer with dynamic date
function updateCountdown() {
    const countdownContainer = document.querySelector('.countdown-container');
    const eventDateTime = countdownContainer.getAttribute('data-event-date');
    const eventDate = new Date(eventDateTime).getTime();
    const now = new Date().getTime();
    const distance = eventDate - now;
    
    if (distance < 0) {
        document.getElementById('days').innerText = '00';
        document.getElementById('hours').innerText = '00';
        document.getElementById('minutes').innerText = '00';
        document.getElementById('seconds').innerText = '00';
        return;
    }
    
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    document.getElementById('days').innerText = days.toString().padStart(2, '0');
    document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
    document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
}

setInterval(updateCountdown, 1000);
updateCountdown();

// Gallery Lightbox
const galleryItems = document.querySelectorAll('.gallery-item');
const lightbox = document.getElementById('lightbox');
const lightboxImage = document.getElementById('lightboxImage');
const lightboxClose = document.querySelector('.lightbox-close');

galleryItems.forEach(item => {
    item.addEventListener('click', function() {
        const imageSrc = this.getAttribute('data-image');
        lightboxImage.src = imageSrc;
        lightbox.style.display = 'block';
    });
});

lightboxClose.addEventListener('click', function() {
    lightbox.style.display = 'none';
});

lightbox.addEventListener('click', function(e) {
    if (e.target === lightbox) {
        lightbox.style.display = 'none';
    }
});

// Music Player
const musicToggle = document.getElementById('musicToggle');
const backgroundMusic = document.getElementById('backgroundMusic');
let isPlaying = false;

// Auto-play music when page loads
window.addEventListener('load', () => {
    backgroundMusic.play().then(() => {
        isPlaying = true;
        musicToggle.classList.add('playing');
    }).catch(e => {
        console.log('Auto-play was prevented');
        // Some browsers prevent autoplay, so we'll try on first user interaction
        document.addEventListener('click', function playOnFirstInteraction() {
            backgroundMusic.play().then(() => {
                isPlaying = true;
                musicToggle.classList.add('playing');
                document.removeEventListener('click', playOnFirstInteraction);
            });
        }, { once: true });
    });
});

musicToggle.addEventListener('click', () => {
    if (isPlaying) {
        backgroundMusic.pause();
        musicToggle.classList.remove('playing');
    } else {
        backgroundMusic.play().catch(e => {
            console.log('Auto-play was prevented');
        });
        musicToggle.classList.add('playing');
    }
    isPlaying = !isPlaying;
});

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offsetTop = target.offsetTop - 70; // Account for fixed navbar
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

// Parallax Effect
//window.addEventListener('scroll', () => {
 //   const scrolled = window.pageYOffset;
   // const parallax = document.querySelector('.hero-section');
    //if (parallax) {
      //  parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
    //}
//});

// Form Enhancement
const form = document.querySelector('.rsvp-form');
if (form) {
    form.addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
    });
}
</script>
@endpush