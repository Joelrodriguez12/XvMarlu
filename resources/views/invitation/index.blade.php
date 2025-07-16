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
                <input type="tel" name="phone" placeholder="Teléfono" required value="{{ old('phone') }}">
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