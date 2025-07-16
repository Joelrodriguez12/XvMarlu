@extends('layouts.app')

@section('content')
<div class="thank-you-container">
    <div class="thank-you-card">
        <div class="thank-you-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="thank-you-title">¡Gracias por Confirmar!</h1>
        <p class="thank-you-message">
            Tu confirmación ha sido recibida exitosamente. 
            Estoy muy emocionada de que puedas acompañarme en este día tan especial.
        </p>
        <div class="thank-you-details">
            <h3>Recuerda:</h3>
            <p><i class="fas fa-calendar"></i> <strong>Fecha:</strong> 2 de Agosto, 2025</p>
            <p><i class="fas fa-glass-cheers"></i> <strong>Recepción:</strong> 6:00 PM</p>
        </div>
        <a href="{{ route('home') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Volver al Inicio
        </a>
    </div>
</div>

<style>
.thank-you-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
    padding: 20px;
}

.thank-you-card {
    background: white;
    border-radius: 20px;
    padding: 60px;
    max-width: 600px;
    width: 100%;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.8s ease-out;
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

.thank-you-icon {
    font-size: 5rem;
    color: #4CAF50;
    margin-bottom: 30px;
    animation: scaleIn 0.5s ease-out 0.3s backwards;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

.thank-you-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    color: #333;
    margin-bottom: 20px;
    font-weight: 400;
}

.thank-you-message {
    font-size: 1.2rem;
    color: #666;
    line-height: 1.8;
    margin-bottom: 40px;
}

.thank-you-details {
    background: #f8f8f8;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
    text-align: left;
}

.thank-you-details h3 {
    font-size: 1.5rem;
    color: #e870b8;
    margin-bottom: 20px;
    text-align: center;
}

.thank-you-details p {
    margin: 15px 0;
    color: #555;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.thank-you-details i {
    color: #e870b8;
    width: 20px;
}

.back-button {
    display: inline-block;
    padding: 15px 40px;
    background: #e870b8;
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(212, 165, 116, 0.3);
}

.back-button:hover {
    background: #f89ad2;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(212, 165, 116, 0.4);
}

.back-button i {
    margin-right: 8px;
}

/* Confetti animation */
.confetti {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
    z-index: 9999;
}

.confetti-piece {
    position: absolute;
    width: 10px;
    height: 10px;
    background: #e870b8;
    animation: confetti-fall 3s linear forwards;
}

@keyframes confetti-fall {
    to {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
    }
}

@media (max-width: 768px) {
    .thank-you-card {
        padding: 40px 30px;
    }
    
    .thank-you-title {
        font-size: 2rem;
    }
    
    .thank-you-icon {
        font-size: 4rem;
    }
}
</style>

<script>
// Create confetti effect
function createConfetti() {
    const confettiContainer = document.createElement('div');
    confettiContainer.className = 'confetti';
    document.body.appendChild(confettiContainer);
    
    const colors = ['#e870b8', '#e8c5a0', '#f4e4d4', '#FFD700', '#FFA500'];
    
    for (let i = 0; i < 100; i++) {
        const confettiPiece = document.createElement('div');
        confettiPiece.className = 'confetti-piece';
        confettiPiece.style.left = Math.random() * 100 + '%';
        confettiPiece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confettiPiece.style.animationDelay = Math.random() * 3 + 's';
        confettiPiece.style.animationDuration = (Math.random() * 3 + 2) + 's';
        confettiContainer.appendChild(confettiPiece);
    }
    
    setTimeout(() => confettiContainer.remove(), 5000);
}

// Run confetti on page load
window.addEventListener('load', createConfetti);
</script>
@endsection