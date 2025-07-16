@extends('layouts.app')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Confirmaciones de Asistencia</h1>
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Invitados</h3>
                    <p class="stat-number">{{ \App\Models\Rsvp::getTotalGuests() }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>Confirmaciones</h3>
                    <p class="stat-number">{{ \App\Models\Rsvp::getTotalConfirmations() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="rsvp-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Invitados</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rsvps as $rsvp)
                    <tr>
                        <td>{{ $rsvp->name }}</td>
                        <td>{{ $rsvp->phone }}</td>
                        <td class="text-center">{{ $rsvp->guests }}</td>
                        <td>{{ $rsvp->message ?: '-' }}</td>
                        <td>{{ $rsvp->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.rsvp.destroy', $rsvp->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta confirmación?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-message">No hay confirmaciones aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $rsvps->links() }}
    </div>

    <div class="export-section">
        <button class="btn-export" onclick="exportToCSV()">
            <i class="fas fa-download"></i> Exportar a CSV
        </button>
    </div>
</div>

<style>
.admin-container {
    max-width: 1200px;
    margin: 100px auto 50px;
    padding: 0 20px;
}

.admin-header {
    margin-bottom: 40px;
}

.admin-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 30px;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    background: #d4a574;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content h3 {
    font-size: 1rem;
    color: #666;
    margin-bottom: 5px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 600;
    color: #333;
}

.alert {
    background: #4CAF50;
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.rsvp-table {
    width: 100%;
    border-collapse: collapse;
}

.rsvp-table thead {
    background: #f8f8f8;
}

.rsvp-table th {
    padding: 20px;
    text-align: left;
    font-weight: 600;
    color: #333;
    border-bottom: 2px solid #e0e0e0;
}

.rsvp-table td {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.rsvp-table tbody tr:hover {
    background: #fafafa;
}

.text-center {
    text-align: center;
}

.btn-delete {
    background: #f44336;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-delete:hover {
    background: #d32f2f;
}

.empty-message {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px !important;
}

.pagination-container {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.export-section {
    margin-top: 40px;
    text-align: center;
}

.btn-export {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-export:hover {
    background: #45a049;
}

.btn-export i {
    margin-right: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    .rsvp-table {
        font-size: 0.9rem;
    }
    
    .rsvp-table th,
    .rsvp-table td {
        padding: 10px;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
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
function exportToCSV() {
    // Get table data
    const table = document.querySelector('.rsvp-table');
    const rows = table.querySelectorAll('tr');
    let csv = [];
    
    // Add headers
    const headers = [];
    rows[0].querySelectorAll('th').forEach(th => {
        if (th.textContent !== 'Acciones') {
            headers.push(th.textContent);
        }
    });
    csv.push(headers.join(','));
    
    // Add data rows
    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].querySelectorAll('td');
        if (cells.length > 1) { // Skip empty rows
            const rowData = [];
            for (let j = 0; j < cells.length - 1; j++) { // Skip actions column
                rowData.push(`"${cells[j].textContent.trim()}"`);
            }
            csv.push(rowData.join(','));
        }
    }
    
    // Download CSV
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `confirmaciones_xv_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection